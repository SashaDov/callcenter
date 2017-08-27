<!--<code><?=__FILE__?></code>
<h4>   <?=$name?> говорит <?=$message?></h4>-->

<button class="btn btn-default" id="b">Press me</button>
<?php
foreach ($articles as $article)
{
    ?>
    <div class="panel panel-default">
    <div class="panel-heading"><?=$article['thema']?>
        <div class="panel-body">
        <?=$article['published_data']?>
        </div>
    </div>
</div>
<?php
}

?>
<script>
    $(document).ready(function () {
        $('#b').click(function () {
            $.ajax({
                url: 'main/test',
                type: 'post',
                data: {'id' : 2},
                success: function (res) {
                    console.log(res);
                },
                error: function () {
                    alert('error');
                }
            });
        });
    });
</script>
