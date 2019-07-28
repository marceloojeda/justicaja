<h3>PAP's Pendentes</h3>
<p>Lista de Pedidos de Abertura de Processo - PAP, em que você figura como <b>Autor, Réu ou Promotor</b> do caso.</p>

<div class="card">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Autor</th>
                <th>Réu</th>
                <th>Data Pedido</th>
                <th>Peças Pendentes</th>
            <tr>
        </thead>
        <tbody>
            <?php 
            foreach($DadosView as $pap){ 
            ?>
                <tr data-autor="<?=$pap['AutorId']?>">
                    <td class="col-md-1"><?=$pap['Id']?></td>
                    <td class="col-md-3"><?=$pap['Autor']?></td>
                    <td class="col-md-4"><?=$pap['Reu']?></td>
                    <td class="col-md-2"><?=$pap['Data']?></td>
                    <td class="col-md-2">
                        <?php
                        //SOMENTE REPLICA
                        if(array_key_exists("Replica", $pap['PecasPendentes']) && !$pap['PecasPendentes']['Replica']) {
                        ?>
                        <div class="btn-group btn-group-justified">
                            <a href="<?=$pap['PecasPendentes']['UrlReplica'];?>" class="btn btn-warning">Réplica</a>
                        </div>
                        <?php } elseif (array_key_exists("Contestacao", $pap['PecasPendentes']) && array_key_exists("Treplica", $pap['PecasPendentes']) && !$pap['PecasPendentes']['Contestacao']) { ?>
                        <div class="btn-group btn-group-justified">
                            <a href="<?=$pap['PecasPendentes']['UrlContestacao'];?>" class="btn btn-warning">Contestação</a>
                        </div>
                        <?php } elseif(array_key_exists("Treplica", $pap['PecasPendentes']) && !$pap['PecasPendentes']['Treplica']) { ?>
                        <div class="btn-group btn-group-justified">
                            <a href="<?=$pap['PecasPendentes']['UrlTreplica'];?>" class="btn btn-warning">Tréplica</a>
                        </div>
                        <?php } else { ?>
                            <i>nenhum</i>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <tbody>
    </table>
</div>