<?php

class Funcionario
{

    private $nome;
    private $matricula;
    private $senha;
    private $conexao;

    public function __construct ($nome, $matricula, $senha, $conexao)

    {
        $this->nome = $nome;
        $this->matricula = $matricula;
        $this->senha = $senha;
        $this->conexao = $conexao;
        }

    public function inserirFuncionario (){

        $sql = "INSERT INTO tbfuncionario (funcionario_nome, funcionario_senha) VALUES (?, ?) ";//relacionados ao banco
        $query = $this->conexao->prepare($sql);
        if (!$query) {
            echo "Erro na preparação da query: " . $this->conexao->error;
            return;
        }

        $query->bind_param("ss", $this->nome, $this->senha);

        if ($query->execute()) {
            header("Location: home.php");
            exit();
        } else {
            echo "Erro ao inserir: " . $query->error;
    }
    }
    public function listarFuncionario(){
        $sql = "SELECT funcionario_matricula, funcionario_nome FROM tbfuncionario";
        $resultado = $this->conexao->query($sql);
        if ($resultado->num_rows > 0) {
            echo "<h3> Listagem de Funcionários:</h3><table>";
            echo "<th>Matrícula</th> <th>Nome</th>";
            foreach ($resultado as $row) {
                $matricula = $row['funcionario_matricula'];
                $nome = $row['funcionario_nome'];
                echo "<tr> <td> $matricula </td> <td> $nome </td> <td>
                        <a href='form_editarFuncionario.php?matricula=$matricula' target='_parent'>Editar</a> |
                        <a href='excluirFuncionario.php?matricula=$matricula' onclick=\"return confirm('Deseja excluir este Funcionário?')\" target='_parent'>Excluir</a>
                    </td> </tr>";
            }
            echo "</table>";
        } else {
            echo "Nenhum funcionário encontrado!";
        }
    }
    public function editarFuncionario(){
        $sql = "UPDATE tbfuncionario SET funcionario_nome = ?, funcionario_senha = ? WHERE funcionario_matricula = ?";
        $query = $this->conexao->prepare($sql);
        $query->bind_param("sss", $this->nome, $this->senha, $this->matricula);

        if ($query->execute()) {
            header("Location: gerenciarfuncionario.php");
            exit();
        } else {
            echo "Erro ao atualizar: " . $query->error;
        }
    }
    public function excluirFuncionario() {
        $sql = "DELETE FROM tbfuncionario WHERE funcionario_matricula = ?";
        $stmt = $this->conexao->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $this->matricula);
            if ($stmt->execute()) {
                
                header("Location: gerenciarfuncionario.php");
                exit();
            } else {
                echo "Erro ao excluir funcionário: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro na preparação da query: " . $this->conexao->error;
        }
    }
}