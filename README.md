# Projeto Laravel - Configuração

Este projeto Laravel requer a configuração de serviços externos para funcionar corretamente. Siga os passos abaixo para configurá-lo:

## Requisitos

-   Conta nas seguintes plataformas:
    -   [Twilio](https://www.twilio.com/)
    -   [Stripe](https://stripe.com/)
    -   [ChatGPT](https://openai.com/)
    -   [Expose](https://expose.dev/)

## Configuração

1. Clone este repositório:
    ```bash
    git clone <url-do-repositorio>
    cd <nome-do-projeto>
    ```

2 Instale as dependencias
`bash
        composer install ou composer install --ignore-platform-reqs
    `

3 Instalar o exposer
`bash
        comando legal
    `

4 Configurar chaves
4.1 Twilio
na sua conta da twilio inicie uma converça com o boot com o numero de telefone que vc vai usar
crie os containers de msg. um para novo usuario e outro par sei la o q
no arquivo  NewUserNotification substitua pelo seu coidogo do seu container de primeira msg 
no arquivo  SubscriptionCompleted substitua pelo seu coidogo do seu container da msg que vc quiser 


4.2 stripe
coloca o id do preço no aquivo stripe service
roda o comando pra gera o webhook
coloca  a key do webhook no .env