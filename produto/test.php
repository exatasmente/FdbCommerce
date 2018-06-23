<?php 
$ch = curl_init("http://localhost/Api/produto/criar.php");
# Setup request to send json via POST.
$payload ='{
	"nome": "Tênis Casual Converse CT AS CORE OX Preto",
	"sku": "TE001",
	"descricao": "Tênis Casual Converse CT AS CORE OX Preto, confeccionada\nem material sintético.\nApresenta ilhós decorativo na\nregião lateral, superfície envernizada e sola emborrachada.\nFechamento por cadarço. A Converse além de ser\nmundialmente conhecida, opta por produtos de qualidade e estilo.",
	"estado": "1",
	"preco_padrao": " 129.90",
	"preco_desconto": "79.99",
	"promocao": "0",
	"quantidade": "100",
	"imagens": [
		"http://placehold.it/350x200"
	],
	"categorias": [
		{
			"idCategoria": "10",
			"nomeCategoria": "Sapato",
			"idPai": "8"
		},
		{
			"idCategoria": "8",
			"nomeCategoria": "Calçados",
			"idPai": "1"
        },
        {
			"idCategoria": "1",
			"nomeCategoria": "Vestuario",
			"idPai": "0"
		}
	],
	"meta_dados": [
		{
			"chave": "Modelo",
			"valor": ["Converse CK00020007"]
		},{
			"chave": "Cor",
			"valor": ["Preto"]
        },
        {
			"chave": "Tendências",
			"valor": ["Básico"]
		}, {
			"chave": "Tipo de frete",
			"valor": ["Leve"]
        },
        {
            "chave":"opcoes",
            "valor":[{"chave":"tamanho","valor":[{"id":"0","nome":"30"},{"id":"0","nome":"40"}]
		
	}]
}
]
}';

curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
$result = curl_exec($ch);
curl_close($ch);


?>