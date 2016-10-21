<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>project</title>
</head>
<body>
    <form action="script/post.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Post Title" required/><br><br>
        <input type="text" name="content" placeholder="Post content" required/><br><br>
        <input type="text" name="author" placeholder="Post author" required/><br><br>
        <input type="file" name="image" value="Enter image"/><br><br>
        <input type="submit" name="post" value="publish hear"/>
            </form>
            
            <select size="1" name="country" onchange="javascript:selectRegion();" style="float:left;">
<option value="">Все страны</option>
<optgroup label="Выберите страну">
<option value="3">Белоруссия</option>
<option value="4">Израиль</option>
<option value="2">Россия</option>
<option value="1">Украина</option>
</optgroup>
</select>

<div name="selectDataRegion" style="float:left;"></div>
<div name="selectDataCity" style="float:left;"></div>
<script type="text/javascript">
            function selectRegion(){
        var id_country = $('select[name="country"]').val();
        if(!id_country){
                $('div[name="selectDataRegion"]').html('');
                $('div[name="selectDataCity"]').html('');
        }else{
                $.ajax({
                        type: "POST",
                        url: "/action/ajax.base.php",
                        data: { action: 'showRegionForInsert', id_country: id_country },
                        cache: false,
                        success: function(responce){ $('div[name="selectDataRegion"]').html(responce); }
                });
        };
};

function selectCity(){
        var id_region = $('select[name="region"]').val();
        $.ajax({
                type: "POST",
                url: "/action/ajax.base.php",
                data: { action: 'showCityForInsert', id_region: id_region },
                cache: false,
                success: function(responce){ $('div[name="selectDataCity"]').html(responce); }
        });
};
            
           </script>
           <?php

ini_set(default_charset,"UTF-8");

# include data base
require "../../mysql.inc.php";

switch ($_POST['action']){
                
        case "showRegionForInsert":
                echo '<select size="1" name="region" onchange="javascript:selectCity();">';
                $rows = $DB->select('SELECT * FROM tbl_region WHERE id_country=? ORDER BY region ASC', $_POST['id_country']);
                foreach ($rows as $numRow => $row) {
                        echo '<option value="'.$row['id_region'].'">'.$row['region'].'</option>';
                };
                echo '</select>';
                break;
                
        case "showCityForInsert":
                echo '<select size="1" name="city">';
                $rows = $DB->select('SELECT * FROM tbl_city WHERE id_region=? ORDER BY city ASC', $_POST['id_region']);
                foreach ($rows as $numRow => $row) {
                        echo '<option value="'.$row['id_city'].'">'.$row['city'].'</option>';
                };
                echo '</select>';
                break;
        
};

?> 
</body>
</html>