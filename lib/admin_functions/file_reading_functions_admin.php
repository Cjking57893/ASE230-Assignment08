<?php
// Modified version of functions for admin page
function read_book_list_admin($file_path): void{

    $file = fopen($file_path,'r');
    //loop runs as long as there is data to read from file
    if(file_exists($file_path)){
        
            $content = file_get_contents($file_path);
            //decode json file and store it
            $json_array = json_decode($content,true);
                
            //write html to page
            foreach($json_array as $book){
            '<br>';
            echo "<tr>
                    <th scope=\"row\"><img src=\"images\book.jpg\" alt=\"Book\" style=\"width: 100px; height: 100px;\"></th>
                        <td class=\"align-middle\"><a href=\"book_detail.php?title=$book[title]\">$book[title]</a></td>
                        <td class=\"align-middle\">$book[author]</td>
                        <td class=\"align-middle\">$book[year]</td>
                        <td class=\"align-middle\">
                            <form method=\"post\">
                                <input type=\"hidden\" name=\"book_title\" value=\"" . htmlspecialchars($book['title']) . "\">
                                <input class=\"btn btn-secondary\" type=\"submit\" value=\"Edit\">
                                <input class=\"btn btn-danger\" type=\"submit\" value=\"Delete\">
                            </form>
                        </td>        
                    </tr>
                    
                    ";
                    

            }
    }
}

function read_club_list_admin($file_path){
    $file = fopen($file_path,'r');
    //loop runs as long as there is data to read from file
    if(file_exists($file_path)){
            $content = file_get_contents($file_path);
            //decode json file and store it
            $json_array = json_decode($content,true);
            //write html to page
            foreach($json_array as $club){
            //write html to page
            '<br>';
            echo "<div class=\"col\">
                            <div class=\"card mt-2 mb-2\" style=\"width: 25rem;\">
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">$club[name]</h5>
                                    <h6 class=\"card-subtitle mb-2 text-body-secondary\">Point of Contact: $club[leader]</h6>
                                    <p class=\"card-text\">$club[description]</p>
                                    <form method=\"post\">
                                        <input type=\"hidden\" name=\"club_name\" value=\"" . htmlspecialchars($club['name']) . "\">
                                        <input class=\"btn btn-secondary\" type=\"submit\" value=\"Edit\">
                                    </form>
                                    <form method=\"post\">
                                        <input type=\"hidden\" name=\"\" value=\"\">
                                        <input class=\"mt-2 btn btn-danger\" type=\"submit\" value=\"Delete\">
                                    </form>
                                </div>
                            </div>
                        </div>";
        }
    }
}