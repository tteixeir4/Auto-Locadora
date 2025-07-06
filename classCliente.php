<?php

class Cliente
{

    private $cpf;
    private $nome;
    private $endereco;
    private $conexao;

    public function __construct ($cpf, $nome, $endereco, $conexao)

    {
        $this->cpf = $cpf;
        $this->nome = $nome; //relacionados do construct
        $this->endereco = $endereco;
        $this->conexao = $conexao;
        }

    public function inserirCliente (){

        $sql = "INSERT INTO tbcliente (cliente_cpf, cliente_nome, cliente_endereco) VALUES (?, ?, ?) ";//relacionados ao banco
        $query = $this->conexao->prepare($sql);
        if (!$query) {
            echo "Erro na preparação da query: " . $this->conexao->error;
            return;
        }

        $query->bind_param("sss", $this->cpf, $this->nome, $this->endereco);

        if ($query->execute()) {
            header("Location: home.php");
            exit();
        } else {
            echo "Erro ao inserir: " . $query->error;
    }
    }
    public function listarCliente(){
        $sql = "SELECT cliente_nome, cliente_cpf, cliente_endereco FROM tbcliente";
        $resultado = $this->conexao->query($sql);
        if ($resultado->num_rows > 0) {
            echo "<h3> Listagem de Clientes:</h3><table>";
            echo "<th>Nome</th> <th>CPF</th> <th>Endereço</th>";
            foreach ($resultado as $row) {
                $nome = $row['cliente_nome'];
                $cpf = $row['cliente_cpf'];
                $endereco = $row['cliente_endereco'];
                echo "<tr> <td> $nome </td> <td> $cpf </td> <td> $endereco </td> <td>
                        <a href='form_editarCliente.php?cpf=$cpf' target='_parent'>Editar</a> |
                        <a href='excluirCliente.php?cpf=$cpf' onclick=\"return confirm('Deseja excluir este cliente?')\" target='_parent'>Excluir</a>
                    </td> </tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum veículo encontrado!";
        }
    }
    public function editarCliente(){
        $sql = "UPDATE tbcliente SET cliente_nome = ?, cliente_endereco = ? WHERE cliente_cpf = ?";
        $query = $this->conexao->prepare($sql);
        $query->bind_param("sss", $this->nome, $this->endereco, $this->cpf);

        if ($query->execute()) {
            header("Location: gerenciarcliente.php");
            exit();
        } else {
            echo "Erro ao atualizar: " . $query->error;
        }
    }
    public function excluirCliente($cpf) {
        $verifica = $this->conexao->prepare("SELECT * FROM tblocacao WHERE locacao_cliente = ?");
        $verifica->bind_param("s", $cpf);
        $verifica->execute();
        $resultado = $verifica->get_result();
    
        if ($resultado->num_rows > 0) {
            echo "Não é possível excluir este cliente, pois ele está vinculado a uma locação.";
            return;
        }
    
        $sql = "DELETE FROM tbcliente WHERE cliente_cpf = ?";
        $stmt = $this->conexao->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $cpf);
            if ($stmt->execute()) {
                header("Location: gerenciarcliente.php");
                exit();
            } else {
                echo "Erro ao excluir cliente: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro na preparação da query: " . $this->conexao->error;
        }
    
        $verifica->close();
    }
}