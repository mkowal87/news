<?php
/**
 * Created by PhpStorm.
 * User: mkowal
 * Date: 12.06.2019
 * Time: 21:02
 */

namespace App\Controller;


/**
 * Class NewsesController
 *
 * @package App\Controller
 */
class NewsesController
{

    /**
     * @var \mysqli
     */
    private $connection;

    /**
     * NewsesController constructor.
     */
    public function __construct()
    {
        $config = include($_SERVER['DOCUMENT_ROOT'].'/config.php');

        try{
            $this->connection = new \mysqli($config['host'], $config['user'], $config['password'], $config['name']);
        }catch (\Exception $e){
            echo $e->getMessage() . '<br>' . 'There have been a connection issue';
        }
    }

    /**
     * Selecting only active newses that will be showed for not logged in users
     * @return array
     */
    public function getActiveNewses() : array
    {
        $sql = 'SELECT * FROM newses 
                WHERE is_active = 1';

        $query = $this->connection->query($sql);
        $data = [];
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }


        return $data;
    }

    /**
     * Fetch all Newses that will be showed for logged in user, so it could be
     * edit or delete.
     * @return array
     */
    public function getAllNewses() : array
    {
        $sql = 'SELECT * FROM newses';

        $query = $this->connection->query($sql);
        $data = [];
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    /**
     * Deleting News
     * @param $id
     */
    public function deleteNews(string $id) : bool
    {

        $deleteSQL = 'DELETE FROM newses 
                WHERE id = "'.$id.'"';

        $query = $this->connection->query($deleteSQL);
        return $query;
    }

    /**
     * Editing News
     * @return bool
     */
    public function editNews() : bool
    {
        foreach ($_POST as $item) {
            //ID is always first
            $id = $item;
            break;
        }

        $updateSQL = 'UPDATE 
                newses SET name = "'.$_POST['editName'.$id].'", 
                description= "'.$_POST['editDescription'.$id].'", 
                is_active = "'.$_POST['editIsActive'.$id].'"
                WHERE id = "'.$id.'"';

        $statement = $this->connection->prepare($updateSQL);

        $query = $statement->execute();

        return $query;
    }

    /**
     * Adding new News
     * @return bool
     */
    public function addNews()
    {

        $sql = 'INSERT 
                INTO newses (name, description, author_id, is_active) 
                VALUES (?, ?, ?, ?);';
        $statement = $this->connection->prepare($sql);

        $statement->bind_param('ssss',
            $_POST['name'],
            $_POST['description'],
            $_SESSION['user_id'],
            $_POST['is_active']
        );
        $query = $statement->execute();

        return $query;
    }
}