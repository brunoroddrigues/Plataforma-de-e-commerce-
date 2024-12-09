# Plataforma de E-commerce - Camisas de Times

Este é um projeto de plataforma de e-commerce para a venda de **camisas de times**, com funcionalidades de **cadastro de usuário**, **login**, **carrinho de compras**, **administração de estoque** e **adicionamento de produtos**. A plataforma também oferece opções de pagamento com **QR code para Pix** e **geração de PDF para boleto bancário**.

# Loja
![printt](https://github.com/user-attachments/assets/8b06c823-53cc-4498-b4a6-16270a52be15)

# Detalhes dos Produtos
![printt pngl](https://github.com/user-attachments/assets/752454e9-384c-4982-b989-07966e63f0f8)

# Boleto Emitido Após a Compra
![sdsdsd](https://github.com/user-attachments/assets/2802f956-39f2-4414-9c4e-2392a2caccae)



## Funcionalidades

### Para o usuário:
- **Cadastro de usuário**: O cliente pode se cadastrar para criar uma conta na plataforma.
- **Login**: Após o cadastro, o cliente pode realizar o login para acessar a plataforma.
- **Carrinho de compras**: O usuário pode adicionar camisas de times ao carrinho, ver detalhes e quantidade de itens.
- **Escolha de forma de pagamento**: O usuário pode escolher entre **Pix (QR code)** ou **boleto bancário** como forma de pagamento.
- **QR Code para Pix**: Geração de um QR code para facilitar o pagamento via Pix.
- **Geração de PDF para boleto bancário**: O cliente pode gerar um boleto bancário em formato PDF para realizar o pagamento.

### Para o administrador:
- **Página de administração**: O administrador tem acesso a uma área dedicada onde pode:
  - **Visualizar o estoque de produtos**.
  - **Adicionar novos produtos** (camisas de times) ao sistema.
  - **Editar e excluir produtos**.
  - **Gerenciar pedidos** e visualizar os detalhes das compras realizadas.

## Tecnologias Utilizadas

- **Backend**: PHP
- **Frontend**: JavaScript, CSS
- **Banco de dados**: MySQL (utilizando MySQL Workbench)
- **Servidor local**: XAMPP
- **Formas de pagamento**:
  - **Pix**: Geração de QR code utilizando a biblioteca `qrcode`
  - **Boleto**: Geração de PDF utilizando a biblioteca `pdfkit`

## Como Rodar o Projeto

### 1. Clonar o repositório

```bash
git clone https://github.com/usuario/repo.git
cd repo
