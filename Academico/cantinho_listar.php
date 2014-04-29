
<pre>
<?php
include "../Classes/cCantinho.class.php";

ini_set ( "display_errors", 1 );

$cantinho = new Cantinho ();
$item = new Cantinho_Item ();
$item->Disciplina->Codigo = 1;
$cantinho->adicionaItem ( $item );
print_r ( $cantinho );

print_r ( $cantinho );
echo "1";
?>
</pre>
