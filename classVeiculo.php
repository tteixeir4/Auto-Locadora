<?php

class Veiculo
{

    private $placa;
    private $marca;
    private $descricao;
    private $conexao;

    public function __construct ($placa, $marca, $descricao, $conexao)

    {
        $this->placa = $placa;
        $this->marca = $marca; //relacionados do construct
        $this->descricao = $descricao;
        $this->conexao = $conexao;
        }


    public function inserirVeiculo(){

        $sql = "INSERT INTO tbveiculo (veiculo_placa, veiculo_marca, veiculo_descricao) VALUES (?, ?, ?) ";//relacionados ao banco
        $query = $this->conexao->prepare($sql);
        if (!$query) {
            echo "Erro na preparação da query: " . $this->conexao->error;
            return;
        }

        $query->bind_param("sis", $this->placa, $this->marca, $this->descricao);

        if ($query->execute()) {
            header("Location: home.php");
            exit();
        } else {
            echo "Erro ao inserir: " . $query->error;
    }
    }
    public function listarVeiculo(){
        $sql = "SELECT v.veiculo_placa AS placa, m.marca_nome AS marca, v.veiculo_descricao AS descricao, v.veiculo_status AS locacao
        FROM tbveiculo v INNER JOIN tbmarca m ON v.veiculo_marca = m.marca_codigo";
        $resultado = $this->conexao->query($sql);
        if ($resultado->num_rows > 0) {
            echo "<h3> Listagem de Veículos:</h3><table>";
            echo "<th>Placa</th> <th>Marca</th> <th>Descrição</th> <th>Status</th>";
            foreach ($resultado as $row) {
                $placa = $row['placa'];
                $marca = $row['marca'];
                $descricao = $row['descricao'];
                $status = $row['locacao'];
                echo "<tr> <td> $placa </td> <td> $marca </td> <td> $descricao </td> <td> $status </td> <td>
                        <a href='form_editarVeiculo.php?placa=$placa' target='_parent'>Editar</a> |
                        <a href='excluirVeiculo.php?placa=$placa' onclick=\"return confirm('Deseja excluir este veículo?')\" target='_parent'>Excluir</a>
                    </td> </tr>";
            }
            echo "</table>";
        } else {
        echo "Nenhum veículo encontrado!";
    }
    }
    public function editarVeiculo(){
        $sql = "UPDATE tbveiculo SET veiculo_marca = ?, veiculo_descricao = ? WHERE veiculo_placa = ?";
        $query = $this->conexao->prepare($sql);
        $query->bind_param("sss", $this->marca, $this->descricao, $this->placa);

        if ($query->execute()) {
            header("Location: gerenciarveiculo.php");
            exit();
        } else {
        echo "Erro ao atualizar: " . $query->error;
        }
    }
    public function excluirVeiculo($placa) {
        $verifica = $this->conexao->prepare("SELECT * FROM tblocacao WHERE locacao_veiculo = ?");
        $verifica->bind_param("s", $placa);
        $verifica->execute();
        $resultado = $verifica->get_result();
    
        if ($resultado->num_rows > 0) {
            echo "Não é possível excluir este veículo, pois ele está vinculado a uma locação.";
            return;
        }
    
        $sql = "DELETE FROM tbveiculo WHERE veiculo_placa = ?";
        $stmt = $this->conexao->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $placa);
            if ($stmt->execute()) {
                header("Location: gerenciarveiculo.php");
                exit();
            } else {
                echo "Erro ao excluir veículo: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro na preparação da query: " . $this->conexao->error;
        }
    
        $verifica->close();
    }
}
