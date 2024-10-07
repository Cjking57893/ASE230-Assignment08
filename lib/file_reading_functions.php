<?php
    //function reads book list
    function read_book_list($file_path): void{
        //iterator for giving unique ID to books
        $i = 0;
        $file = fopen($file_path,'r');
        //loop runs as long as there is data to read from file
        if(file_exists($file_path)){
            
                $content = file_get_contents($file_path);
                //decode json file and store it
                $json_array = json_decode($content,true);
                  
                //write html to page
                foreach($json_array as $book){
                '<br>';
                echo "<tr id=\"$i\">
                        <th scope=\"row\"><img src=\"images\book.jpg\" alt=\"Book\" style=\"width: 100px; height: 100px;\"></th>
                            <td class=\"align-middle\"><a href=\"book_detail.php\">$book[title]</a></td>
                            <td class=\"align-middle\">$book[author]</td>
                            <td class=\"align-middle\">$book[year]</td>
                        </tr>";
                }
            
            $i++;
        }
    }

    function read_club_list($file_path){
        //iterator for giving unique ID to clubs
        $i = 0;
        $file = fopen($file_path,'r');
        //loop runs as long as there is data to read from file
        if(file_exists($file_path)){
                $content = file_get_contents($file_path);
                //decode json file and store it
                $json_array = json_decode($content,true);
                //write html to page
                foreach($json_array as $book){
                //write html to page
                '<br>';
                echo "<div class=\"col\" id=\"$i\">
                                <div class=\"card mt-2 mb-2\" style=\"width: 25rem;\">
                                    <div class=\"card-body\">
                                        <h5 class=\"card-title\">$book[name]</h5>
                                        <h6 class=\"card-subtitle mb-2 text-body-secondary\">Point of Contact: $book[leader]</h6>
                                        <p class=\"card-text\">$book[description]</p>
                                        <a href=\"#\" class=\"card-link\">Join Club</a>
                                        <a href=\"#\" class=\"card-link\">Not Interested</a>
                                    </div>
                                </div>
                            </div>";
                $i++;
            }
        }
    }