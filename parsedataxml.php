<?php

//Remove StopWords
function removeStopWords($input){
 
  // EEEEEEK Stop words
  $stopWords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero');
 
  return preg_replace('/\b('.implode('|',$stopWords).')\b/','',$input);
}

//Remove StopWords

//Porter's

$regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';

function Stem($word)
        {
            if (strlen($word) <= 2) {
                return $word;
            }

            $word = step1ab($word);
            $word = step1c($word);
            $word = step2($word);
            $word = step3($word);
            $word = step4($word);
            $word = step5($word);

            return $word;
        }

 function step1ab($word)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            // Part a
            if (substr($word, -1) == 's') {

                   replace($word, 'sses', 'ss')
                OR replace($word, 'ies', 'i')
                OR replace($word, 'ss', 'ss')
                OR replace($word, 's', '');
            }

            // Part b
            if (substr($word, -2, 1) != 'e' OR !replace($word, 'eed', 'ee', 0)) { // First rule
                $v = $regex_vowel;

                // ing and ed
                if (   preg_match("#$v+#", substr($word, 0, -3)) && replace($word, 'ing', '')
                    OR preg_match("#$v+#", substr($word, 0, -2)) && replace($word, 'ed', '')) { // Note use of && and OR, for precedence reasons

                    // If one of above two test successful
                    if (    !replace($word, 'at', 'ate')
                        AND !replace($word, 'bl', 'ble')
                        AND !replace($word, 'iz', 'ize')) {

                        // Double consonant ending
                        if (    doubleConsonant($word)
                            AND substr($word, -2) != 'll'
                            AND substr($word, -2) != 'ss'
                            AND substr($word, -2) != 'zz') {

                            $word = substr($word, 0, -1);

                        } else if (m($word) == 1 AND cvc($word)) {
                            $word .= 'e';
                        }
                    }
                }
            }

            return $word;
        }


 function step1c($word)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            $v = $regex_vowel;

            if (substr($word, -1) == 'y' && preg_match("#$v+#", substr($word, 0, -1))) {
                replace($word, 'y', 'i');
            }

            return $word;
        }

function step2($word)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            switch (substr($word, -2, 1)) {
                case 'a':
                       replace($word, 'ational', 'ate', 0)
                    OR replace($word, 'tional', 'tion', 0);
                    break;

                case 'c':
                       replace($word, 'enci', 'ence', 0)
                    OR replace($word, 'anci', 'ance', 0);
                    break;

                case 'e':
                    replace($word, 'izer', 'ize', 0);
                    break;

                case 'g':
                    replace($word, 'logi', 'log', 0);
                    break;

                case 'l':
                       replace($word, 'entli', 'ent', 0)
                    OR replace($word, 'ousli', 'ous', 0)
                    OR replace($word, 'alli', 'al', 0)
                    OR replace($word, 'bli', 'ble', 0)
                    OR replace($word, 'eli', 'e', 0);
                    break;

                case 'o':
                       replace($word, 'ization', 'ize', 0)
                    OR replace($word, 'ation', 'ate', 0)
                    OR replace($word, 'ator', 'ate', 0);
                    break;

                case 's':
                       replace($word, 'iveness', 'ive', 0)
                    OR replace($word, 'fulness', 'ful', 0)
                    OR replace($word, 'ousness', 'ous', 0)
                    OR replace($word, 'alism', 'al', 0);
                    break;

                case 't':
                       replace($word, 'biliti', 'ble', 0)
                    OR replace($word, 'aliti', 'al', 0)
                    OR replace($word, 'iviti', 'ive', 0);
                    break;
            }

            return $word;
        }

function step3($word)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            switch (substr($word, -2, 1)) {
                case 'a':
                    replace($word, 'ical', 'ic', 0);
                    break;

                case 's':
                    replace($word, 'ness', '', 0);
                    break;

                case 't':
                       replace($word, 'icate', 'ic', 0)
                    OR replace($word, 'iciti', 'ic', 0);
                    break;

                case 'u':
                    replace($word, 'ful', '', 0);
                    break;

                case 'v':
                    replace($word, 'ative', '', 0);
                    break;

                case 'z':
                    replace($word, 'alize', 'al', 0);
                    break;
            }

            return $word;
        }


function step4($word)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            switch (substr($word, -2, 1)) {
                case 'a':
                    replace($word, 'al', '', 1);
                    break;

                case 'c':
                       replace($word, 'ance', '', 1)
                    OR replace($word, 'ence', '', 1);
                    break;

                case 'e':
                    replace($word, 'er', '', 1);
                    break;

                case 'i':
                    replace($word, 'ic', '', 1);
                    break;

                case 'l':
                       replace($word, 'able', '', 1)
                    OR replace($word, 'ible', '', 1);
                    break;

                case 'n':
                       replace($word, 'ant', '', 1)
                    OR replace($word, 'ement', '', 1)
                    OR replace($word, 'ment', '', 1)
                    OR replace($word, 'ent', '', 1);
                    break;

                case 'o':
                    if (substr($word, -4) == 'tion' OR substr($word, -4) == 'sion') {
                       replace($word, 'ion', '', 1);
                    } else {
                        replace($word, 'ou', '', 1);
                    }
                    break;

                case 's':
                    replace($word, 'ism', '', 1);
                    break;

                case 't':
                       replace($word, 'ate', '', 1)
                    OR replace($word, 'iti', '', 1);
                    break;

                case 'u':
                    replace($word, 'ous', '', 1);
                    break;

                case 'v':
                    replace($word, 'ive', '', 1);
                    break;

                case 'z':
                    replace($word, 'ize', '', 1);
                    break;
            }

            return $word;
        }
function step5($word)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            // Part a
            if (substr($word, -1) == 'e') {
                if (m(substr($word, 0, -1)) > 1) {
                    replace($word, 'e', '');

                } else if (m(substr($word, 0, -1)) == 1) {

                    if (!cvc(substr($word, 0, -1))) {
                        replace($word, 'e', '');
                    }
                }
            }

            // Part b
            if (m($word) > 1 AND doubleConsonant($word) AND substr($word, -1) == 'l') {
                $word = substr($word, 0, -1);
            }

            return $word;
        }

function replace(&$str, $check, $repl, $m = null)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            $len = 0 - strlen($check);

            if (substr($str, $len) == $check) {
                $substr = substr($str, 0, $len);
                if (is_null($m) OR m($substr) > $m) {
                    $str = $substr . $repl;
                }

                return true;
            }

            return false;
        }

function m($str)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            $c = $regex_consonant;
            $v = $regex_vowel;

            $str = preg_replace("#^$c+#", '', $str);
            $str = preg_replace("#$v+$#", '', $str);

            preg_match_all("#($v+$c+)#", $str, $matches);

            return count($matches[1]);
        }

function doubleConsonant($str)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            $c = $regex_consonant;

            return preg_match("#$c{2}$#", $str, $matches) AND $matches[0]{0} == $matches[0]{1};
        }

 function cvc($str)
        {

          $regex_consonant = '(?:[bcdfghjklmnpqrstvwxz]|(?<=[aeiou])y|^y)';

$regex_vowel = '(?:[aeiou]|(?<![aeiou])y)';
            $c = $regex_consonant;
            $v = $regex_vowel;

            return     preg_match("#($c$v$c)$#", $str, $matches)
                   AND strlen($matches[1]) == 3
                   AND $matches[1]{2} != 'w'
                   AND $matches[1]{2} != 'x'
                   AND $matches[1]{2} != 'y';
        }

//Porter's

$initsqlfilehandler = fopen("init.sql","a");

$data = file_get_contents("ohsumed87.txt");

$newdata = str_replace("&", "", $data);
$newdata = "<data>".$newdata."</data>";

file_put_contents("data.xml", $newdata);



$dropIRTableBeforeCreation = "drop table if exists InformationRetrievalTable;";
$createIRTable = "create table InformationRetrievalTable (DocumentID int(11) not null ,Word varchar(45) not null ,WordCount int(11) ,primary key (DocumentID,Word));";

$dropCKTable = "drop table if exists CountKeeperTable;";
$cretaCKTable = "create table CountKeeperTable (DocumentID int(11) not null ,FreqCount int(11) not null, DocumentTitle varchar(200), DocumentAuthor varchar(100), DocumentSource varchar(300));";

$setuptables = $dropIRTableBeforeCreation."\r\n".$createIRTable."\r\n".$dropCKTable."\r\n".$cretaCKTable."\r\n";

fwrite($initsqlfilehandler,$setuptables);
// $mysqli->query($dropIRTableBeforeCreation);
// $mysqli->query($createIRTable);
// $mysqli->query($dropCKTable);
// $mysqli->query($cretaCKTable);

$docxml=simplexml_load_file("data.xml");

foreach ($docxml->I as $I) {
  $abstract = $I->W;
  $title = $I->T;
  $mesh = $I->M;
  $author = $I->A;
  
  $abstractafterremovingstopwords = removeStopWords($abstract);
  $titleafterremovingstopwords = removeStopWords($title);
  $meshafterremovingstopwords = removeStopWords($mesh);
  $authorafterremovingstopwords = removeStopWords($author); 

  $words = explode(' ', $abstractafterremovingstopwords);
  $words1 = explode(' ', $titleafterremovingstopwords);
  $words2 = explode(' ', $meshafterremovingstopwords);
  $words3 = explode(' ', $authorafterremovingstopwords);

  $words = array_merge($words,$words1,$words2,$words3);

//for each $word in $words
  foreach($words as $word)
  {
      
          //echo the $word
          $stemmedWord = Stem($word);
          if(strlen($stemmedWord)>0){
                if($stemmedWord=="Gov',"){
                    $stemmedWord ="Gov";
                }
                if($stemmedWord=="Boerhaave'"){
                    $stemmedWord ="Boerhaave";
                }
                if($stemmedWord=="patients'"){
                    $stemmedWord ="patients";
                }
                $stemmedWord=str_replace("'","",$stemmedWord);
                $thetempkey = $I->U."|".$stemmedWord;
                $thetempkey = strtolower($thetempkey);
                if(!isset($thetemparr[$thetempkey])){
                     
                    $insertquery = "INSERT INTO InformationRetrievalTable VALUES (".$I->U.",'".strtolower($stemmedWord)."',1);";
                    fwrite($initsqlfilehandler,$insertquery."\r\n");
                    //echo $insertquery."<br/>";
                    $thetemparr[$thetempkey] = "True";
                }
                else{
                    
                    $updatequery = "UPDATE InformationRetrievalTable SET WordCount = WordCount + 1 WHERE DocumentID = ".$I->U." and Word = '".strtolower($stemmedWord)."'".";";
                    fwrite($initsqlfilehandler,$updatequery."\r\n");
                    //echo $updatequery."<br/>";
                }
                
            }
  }
  //echo $abstractafterremovingstopwords;
  //echo '<br/><br/>';
  //break;
}
fclose($initsqlfilehandler);

?>