<?php
require_once 'Database.php';
require_once 'Component.php';


class Operations
{
    //DB stuff
    private $conn;
    private $table = 'books';

    //Book Properties
    public $id;
    public $price;
    public $publisher;
    public $bookname;

    //btn property
    public  $component;
    //message properties
    public $message_classname;
    public $msg;
    public function __construct($conn,$component)
    {
        $this->conn = $conn;
        $this->component = $component;
    }
    //messages style
    public function textNode($classname, $msg): string
    {
        $this->message_classname = $classname;
        $this->msg = $msg;

        return "<h6 class='$this->message_classname'>$this->msg</h6>";
    }
    //create a new records
    public function createData()
    {
        if (isset($_POST['create']))
        {
            //assign values
            $this->price = $_POST['price'];
            $this->bookname = $_POST['book_name'];
            $this->publisher = $_POST['publisher'];

            //clean data
            $this->bookname = htmlspecialchars(strip_tags($this->bookname));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->publisher = htmlspecialchars(strip_tags($this->publisher));

            if ($this->price && $this->bookname && $this->publisher)
            {
                //create array data
                $data = [
                    'name' => $this->bookname,
                    'publisher' => $this->publisher,
                    'price' => $this->price,
                ];

                //Create a query
                $query = "INSERT INTO $this->table (book_name, book_publisher, book_price) 
                          VALUES (:name, :publisher, :price)";
                //Prepare query
                $stmt = $this->conn->prepare($query);

                //Execute Query
                if ($stmt->execute($data))
                {
                    echo $this->textNode("success","Records inserted successfully..!"); ;
                }
                else
                {
                    echo $this->textNode("error","error");
                }
            }
            else
            {
                echo $this->textNode("error","The input fields are required..!");
            }

        }
    }
    //get records
    public function readData()
    {
        //Create  query
        $query = "SELECT * FROM $this->table";
        //Prepare query
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }
    //update the records
    public function updateData()
    {
        if(isset($_POST['update']))
        {
            //assign values
            $this->id = $_POST['id'];
            $this->price = $_POST['price'];
            $this->bookname = $_POST['book_name'];
            $this->publisher = $_POST['publisher'];
        }
        if($this->price && $this->bookname && $this->publisher && $this->id)
        {
            //create array data
            $data = [
                'id' => $this->id,
                'name' => $this->bookname,
                'publisher' => $this->publisher,
                'price' => $this->price
            ];

            //create query
            $query = "UPDATE $this->table SET book_name=:name, book_publisher=:publisher, 
                 book_price=:price WHERE id=:id";
            //prepare  query
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->bookname));
            $this->bookname = htmlspecialchars(strip_tags($this->bookname));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->publisher = htmlspecialchars(strip_tags($this->publisher));

            //Execute the query
            if($stmt->execute($data))
            {
                echo $this->textNode('success','Records updated successfully..!');
            }
            else
            {
                echo $this->textNode('error','No records are updated..!');
            }
        }

    }
    //delete data
    public function deleteData()
    {
        if(isset($_POST['delete']))
        {
            //assign id value
            $this->id = $_POST['id'];
            //create a query
            $query = "DELETE FROM $this->table WHERE id=$this->id";
            //prepare the query
            $stmt = $this->conn->prepare($query);
            //execute the query
            if($stmt->execute())
            {
                echo $this->textNode('success','Records deleted Successfully..!');
            }
            else
            {
                echo $this->textNode('error','Select records to delete..!');
            }
        }

    }
    //Show Delete btn
    public function ShowDeleteBtn()
    {
        $result = $this->readData();
        $i = 0;
        if($result)
        {
            while ($row = $result->fetch())
            {
                $i++;
            }
            if($i > 3)
            {
                echo $this->component->createButton('btn-deleteAll','btn btn-danger','DeleteAll','deleteall',
                    "dat-toggle='tooltip' data-placement='bottom' title='DeleteAll'",'<i class="fas fa-trash"></i>DeleteAll');
                return;
            }
        }

    }
    //delete all
    public function deleteAll()
    {
        if(isset($_POST['deleteall']))
        {
            //create query
            $query = "DELETE FROM $this->table";
            //prepare query
            $stmt = $this->conn->prepare($query);
            //execute the query
            if($stmt->execute())
            {
                echo $this->textNode('success','All records  deleted..!');
            }
        }
    }




}