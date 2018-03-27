<!DOCTYPE html>
<html>
<body>

<h2>The received drugs are: </h2>

<?php
$keywords = $_POST["keywords"];
$keywords = explode(' ', $keywords);
$drug1 = strtolower($keywords[0]);
$drug2 = strtolower($keywords[count($keywords)-1]);

echo $drug1."<br />";
echo $drug2."<br />";

$config = array(
    'db'    => array(
        'host'      => '127.0.0.1',
        'user'      => 'root',
        'pass'      => 'liang123',
        'db'        => 'ddi',
        'dns'       => 'mysql:dbname=ddi;host=127.0.0.1;charset=utf8'
    )
);

try {
    $db = new PDO($config['db']['dns'], $config['db']['user'], $config['db']['pass']);
    $sql = "SELECT COUNT(*) FROM ddi_informations WHERE (drug1='" . $drug1 . "' and drug2 = '" . $drug2 . "') or (drug2='" . $drug1 . "' and drug1 = '" . $drug2 . "')";
    $res = $db->query($sql);
    $num = $res->fetchColumn();
    echo "<h2>";
    printf("%d ", $num);
    echo " records.";
    echo "</h2>";
    if ($num > 0) {
        $sql = "SELECT year, pmid, sentence, ddi_type FROM ddi_informations WHERE (drug1='" . $drug1 . "' and drug2 = '" . $drug2 . "') or (drug2='" . $drug1 . "' and drug1 = '" . $drug2 . "')";
        foreach ($db->query($sql) as $row) {
            echo "<br />";
            echo "PMID: " .  $row['pmid'] . "<br />";
            echo "Year: " .  $row['year'] . "<br />";
            echo "Predicted DDI: " . $row['ddi_type'] . "<br />";
            echo "Sentence: " . str_replace(array("###END###"),"",$row['sentence']) . "<br />";
            echo "Paper ";
            echo "<a href='https://www.ncbi.nlm.nih.gov/pubmed/" . $row['pmid'] . "' target='_blank'>link</a><br />";
        }
    } 

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}



?>

</body>
</html>

