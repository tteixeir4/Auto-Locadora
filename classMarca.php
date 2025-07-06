<?php

class Marca
{

    private $codigo;
    private $nome;
    private $conexao;

    public function __construct ($codigo, $nome, $conexao)

    {
        $this->codigo = $codigo;
        $this->nome = $nome; //relacionados do construct
        $this->conexao = $conexao;
        }

    public function inserirMarca (){

        $sql = "INSERT INTO tbmarca (marca_nome) VALUES (?) ";//relacionados ao banco
        $query = $this->conexao->prepare($sql);
        $query->bind_param("s", $this->nome);

        //$query = $this->conexao->execute($sql);

        if ($query->execute()) {
            header("Location: gerenciarmarca.php");
            exit();
        } else {
            echo "Erro ao inserir: " . $query->error;
    }
    }
    public function listarMarca(){
        $sql = "SELECT marca_codigo, marca_nome FROM tbmarca";
        $resultado = $this->conexao->query($sql);
        if ($resultado->num_rows > 0) {
            echo "<h3> Listagem de Marcas:</h3><table>";
            echo "<th>Código</th> <th>Marcas</th>";
            foreach ($resultado as $row) {
                $codigo = $row['marca_codigo'];
                $nome = $row['marca_nome'];
                echo "<tr> <td> $codigo </td> <td> $nome </td> <td>
                        <a href='form_editarMarca.php?codigo=$codigo' target='_parent'>Editar</a>
                        <a href='excluirMarca.php?codigo=$codigo' onclick=\"return confirm('Deseja excluir esta marca?')\" target='_parent'>Excluir</a>
                    </td> </tr>";
            }
            echo "</table>";
        } else {
        echo "Nenhuma marca encontrada!";
    }
    }
    public function editarMarca(){
        $sql = "UPDATE tbmarca SET marca_nome = ? WHERE marca_codigo = ?";
        $query = $this->conexao->prepare($sql);
        $query->bind_param("si", $this->nome, $this->codigo);

        if ($query->execute()) {
            header("Location: gerenciarmarca.php");
            exit();
        } else {
        echo "Erro ao atualizar: " . $query->error;
        }
    }
    public function excluirMarca() {
    
        $sql = "DELETE FROM tbmarca WHERE marca_codigo = ?";
        $stmt = $this->conexao->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $this->codigo);
            if ($stmt->execute()) {
                header("Location: gerenciarmarca.php");
                exit();
            } else {
                echo "Erro ao excluir marca: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Erro na preparação da query: " . $this->conexao->error;
        }
    
        $verifica->close();
    }
}
