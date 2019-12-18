<?php
class PreviewProvider
{
  private $con, $username;
  public function __construct($con, $username)
  {
    $this->con = $con;
    $this->username = $username;
  }
  public function createPreviewVideo($entity)
  {
    //Use this function when choose certain entity on index.php
    //Thus if entity if null, return a random entity in db
    if ($entity == null) {
      $entity = $this->getRandomEntity();
    }

    $id = $entity->getId();
    $name = $entity->getName();
    $preview = $entity->getPreview();
    $thumbnail = $entity->getThumbnail();
  }
  private function getRandomEntity()
  {
    $query = $this->con->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC); //row will be an associative array, aka key value pairs

    return new Entity($this->con, $row);
  }
}
