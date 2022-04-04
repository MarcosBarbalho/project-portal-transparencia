<?php
    for ($i=1; $i < 3; $i++) {
        $url = "http://api.portaldatransparencia.gov.br/api-de-dados/bolsa-familia-disponivel-por-cpf-ou-nis?codigoIbge=3106705&mesAno=202101&pagina=".$i;

        $client = curl_init($url);

        $headers = ['chave-api-dados: b651b4ef92d868c9902a84c8e8151b64'];

        curl_setopt($client, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($client);

        $content[$i] = json_decode($response);

        curl_close($client);
    }

    var_dump($response);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <title>Consulta 1</title>
</head>

<body>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>NIS</th>
                <th>Mês</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($content as $value): ?>
            <?php foreach($value as $xyz): ?>
            <tr>
                <td><?php echo $xyz->titularBolsaFamilia->cpfFormatado; ?></td>
                <td><?php echo $xyz->titularBolsaFamilia->nome; ?></td>
                <td><?php echo $xyz->titularBolsaFamilia->nis; ?></td>
                <td><?php echo $xyz->dataMesCompetencia; ?></td>
                <td><?php echo $xyz->valor; ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>

</html>