<h1 align='center'>
    <strong><span style: style="color:#F20505">T</span>ODAY <span style: style="color:#F20505">N</span>EWS</strong>
</h1>

# 📃 **Sobre**

Today News é um mini portal de noticías desenvolvido por mim para por em prática algumas técnicas de persistência de dados orientado a objetos. 

O sistema foi estruturado de uma maneira em que o SQL, HTML e PHP ficassem separados em camadas diferentes, permitindo desta maneira uma revisão e manutenção mais fácil do código. 

Há somente uma classe de persistência de dados responsável por toda a persistência no banco de dados. Também foi utilizado PDO para fazer a conexão com o mesmo.

Na modelagem do banco foi utilizado o relacionamento N X N, foram criadas três tabelas respeitando a segunda forma normal de Codd. Uma tabela responsável por cadastrar as categorias, outra para cadastrar as notícias e mais uma relacionando as duas.

---

## 🎮 **Funcionalidades :**

- Exibição das noticías cadastradas.
- Criação e cadastro das notícias no banco de dados.
- Busca das notícias cadastradas.
- Paginação de notícias


---


## ✅ Tecnologias Utilizadas

O projeto foi desenvolvido utilizando as seguintes tecnologias:

- PHP
- HTML
- CSS
- Mysql
