# Documentação de Instalação do Sistema

## Requisitos
Antes de mais nada, você vai precisar do Docker instalado no seu computador. Se ainda não tem, dá uma olhada na documentação oficial do Docker para instalar a versão correta para o seu sistema operacional:

- [Docker Documentation - Get Docker](https://docs.docker.com/get-started/get-docker/)

### Importante para usuários Windows
Se você estiver usando Windows, é necessário ter o pacote `make` instalado. Você pode usar o Chocolatey ou o WSL (Windows Subsystem for Linux) para facilitar isso:

- [Chocolatey - The package manager for Windows](https://chocolatey.org/)

#### Instalar o WSL
Instale o Subsistema do Windows para Linux com o comando `wsl --install`. Use um terminal Bash em seu computador Windows executado pela distribuição do Linux de sua preferência: Ubuntu, Debian, SUSE, Kali, Fedora, Pengwin, Alpine e muitas outras disponíveis.

---

## Passo a Passo da Instalação

### Clone o repositório do GitHub:
Abra seu terminal e execute o seguinte comando:
```bash
git clone https://github.com/victoriafe/dscnovo
```

### Navegue até o diretório do projeto:
Entre na pasta que você acabou de clonar:
```bash
cd dscnovo
```

### Configure o ambiente:
Execute o comando abaixo para configurar o ambiente:
```bash
make setup
```

---

## Acesso ao Sistema
Depois que tudo estiver configurado, você pode acessar o sistema pelo seu navegador. Abra o seguinte link:

- [http://localhost](http://localhost)

E se precisar acessar o phpMyAdmin, é só ir em:

- [http://localhost:8090](http://localhost:8090)

### A senha de acesso de login ao sistema
- **Usuário**: admin
- **Senha**: admin


- **Usuário**: waiter1
- **Senha**: waiter

## Detalhes
- **Na tela de Relatorios, é necessario atualizar a pagina para vizualizar todas as informações**
