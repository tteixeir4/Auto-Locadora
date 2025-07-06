<?php

class Locacao
{
    private $codigo;
    private $veiculo;
    private $cliente;
    private $inicio;
    private $fim;
    private $conexao;

    public function __construct ($cliente, $veiculo, $inicio, $fim, $conexao)

    {
        $this->cliente = $cliente;
        $this->veiculo = $veiculo; //relacionados do construct
        $this->inicio = $inicio;
        $this->fim = $fim;
        $this->conexao = $conexao;
        }

    public function inserirLocacao () {
        $sql = "INSERT INTO tblocacao (locacao_cliente, locacao_veiculo, locacao_data_inicio, locacao_data_fim) VALUES (?, ?, ?, ?)";
        $query = $this->conexao->prepare($sql);
        if (!$query) {
            echo "Erro na preparação da query: " . $this->conexao->error;
            return;
        }
        
        $query->bind_param("ssss", $this->cliente, $this->veiculo, $this->inicio, $this->fim);
        
        if ($query->execute()) {
            $atualizaStatus = $this->conexao->prepare("UPDATE tbveiculo SET veiculo_status = 'locado' WHERE veiculo_placa = ?");
            if ($atualizaStatus) {
                $atualizaStatus->bind_param("s", $this->veiculo);
                $atualizaStatus->execute();
                $atualizaStatus->close();
            } else {
                echo "Erro ao atualizar status do veículo: " . $this->conexao->error;
            }
        
            header("Location: gerenciarlocacao.php");
            exit();
        } else {
            echo "Erro ao inserir: " . $query->error;
        }
    }
    public function listarLocacao(){
    $sql = "SELECT tblocacao.locacao_codigo, tblocacao.locacao_veiculo, tblocacao.locacao_cliente, tblocacao.locacao_data_inicio, tblocacao.locacao_data_fim, tbveiculo.veiculo_descricao, tbcliente.cliente_nome
            FROM tblocacao
            JOIN tbveiculo ON tblocacao.locacao_veiculo = tbveiculo.veiculo_placa
            JOIN tbcliente ON tblocacao.locacao_cliente = tbcliente.cliente_cpf";
        $resultado = $this->conexao->query($sql);
        if ($resultado->num_rows > 0) {
            echo "<h3> Listagem de Locações:</h3><table>";
            echo "<th> Código da locação</th> <th>CPF do cliente</th> <th>Nome do cliente</th> <th>Placa do Veículo</th> <th>Nome do veículo</th> <th>Data de início</th> <th>Data final</th>";
            foreach ($resultado as $row) {
                $codigo = $row['locacao_codigo'];
                $cpf = $row['locacao_cliente'];
                $cliente = $row['cliente_nome'];
                $placa = $row['locacao_veiculo'];
                $veiculo = $row['veiculo_descricao'];
                $inicio = $row['locacao_data_inicio'];
                $fim = $row['locacao_data_fim'];
                echo "<tr> <td> $codigo </td> <td> $cpf </td> <td> $cliente </td> <td> $placa </td> <td> $veiculo </td> <td> $inicio </td> <td> $fim </td> <td>
                        <a href='form_editarLocacao.php?codigo=$codigo' target='_parent'>Editar</a>
                        <a href='excluirLocacao.php?codigo=$codigo' onclick=\"return confirm('Deseja excluir esta locação?')\" target='_parent'>Excluir</a>
                    </td> </tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhuma locação encontrada!";
        }
}
    public function editarLocacao($codigo){
        $sql = "UPDATE tblocacao SET locacao_cliente = ?, locacao_veiculo = ?, locacao_data_inicio = ?, locacao_data_fim = ? WHERE locacao_codigo = ?";
        $query = $this->conexao->prepare($sql);
        if (!$query) {
            echo "Erro na preparação da query: " . $this->conexao->error;
            return;
        }

        $query->bind_param("ssssi", $this->cliente, $this->veiculo, $this->inicio, $this->fim, $codigo);

        if ($query->execute()) {
            header("Location: gerenciarlocacao.php");
            exit();
        } else {
            echo "Erro ao atualizar: " . $query->error;
        }
    }
    public function excluirLocacao($codigo) {
        // Primeiro, pegar a placa do veículo desta locação
        $select = $this->conexao->prepare("SELECT locacao_veiculo FROM tblocacao WHERE locacao_codigo = ?");
        $select->bind_param("i", $codigo);
        $select->execute();
        $select->bind_result($veiculo);
        $select->fetch();
        $select->close();
    
        // Excluir a locação
        $query = $this->conexao->prepare("DELETE FROM tblocacao WHERE locacao_codigo = ?");
        $query->bind_param("i", $codigo);
    
        if ($query->execute()) {
            $query->close();
    
            // Verificar se o veículo ainda está em alguma locação
            $check = $this->conexao->prepare("SELECT COUNT(*) FROM tblocacao WHERE locacao_veiculo = ?");
            $check->bind_param("s", $veiculo);
            $check->execute();
            $check->bind_result($count);
            $check->fetch();
            $check->close();
    
            // Se não houver mais locações, atualizar o status para 'disponível'
            if ($count == 0) {
                $updateStatus = $this->conexao->prepare("UPDATE tbveiculo SET veiculo_status = 'disponível' WHERE veiculo_placa = ?");
                $updateStatus->bind_param("s", $veiculo);
                $updateStatus->execute();
                $updateStatus->close();
            }
    
            header("Location: gerenciarlocacao.php");
            exit();
        } else {
            echo "Erro ao excluir locação: " . $query->error;
        }
    }
}
    
