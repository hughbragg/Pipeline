<?phpclass Update extends DbObject{	protected $id;	protected $creatorID;	protected $acceptedID;	protected $projectID;	protected $title;	protected $message;	protected $dateCreated;		const DB_TABLE = '`update`';		public function __construct($args=array())	{		$defaultArgs = array(			'id' => null,			'creator_id' => 0,			'accepted_id' => 0,			'project_id' => 0,			'title' => '',			'message' => '',			'date_created' => null		);					$args += $defaultArgs;				$this->id = $args['id'];		$this->creatorID = $args['creator_id'];		$this->projectID = $args['project_id'];				$this->acceptedID = $args['accepted_id'];		$this->title = $args['title'];		$this->message = $args['message'];		$this->dateCreated = $args['date_created'];			}	public static function load($id)	{		$db = Db::instance();		$obj = $db->fetch($id, __CLASS__, self::DB_TABLE);		return $obj;	}			public function save()	{		$db = Db::instance();		// map database fields to class properties; omit id and dateCreated		$db_properties = array(			'creator_id' => $this->creatorID,			'project_id' => $this->projectID,			'accepted_id' => $this->acceptedID,				'title' => $this->title,			'message' => $this->message		);				$db->store($this, __CLASS__, self::DB_TABLE, $db_properties);	}				public function getComments() {		return (Comment::getByUpdateID($this->getID()));	}		public function isLatestUpdate() {		$accepted = Accepted::load($this->getAcceptedID());		$latestUpdate = $accepted->getLatestUpdate();		if($latestUpdate->getID() == $this->id)			return true;		else			return false;	}	public static function getByAcceptedID($acceptedID=null)	{		if($acceptedID == null) return null;				$query = "SELECT id FROM ".self::DB_TABLE;		$query .= " WHERE accepted_id = ".$acceptedID;		$query .= " ORDER BY date_created DESC";				$db = Db::instance();		$result = $db->lookup($query);		if(!mysql_num_rows($result)) return array();		$updates = array();		while($row = mysql_fetch_assoc($result))			$updates[$row['id']] = self::load($row['id']);		return $updates;						}			public static function getByUserID($userID=null, $limit=null) {		if($userID == null) return null;				$query = "SELECT u.id AS id FROM ".self::DB_TABLE." u";		$query .= " INNER JOIN ".Accepted::DB_TABLE." a ON ";		$query .= " u.accepted_id = a.id";		$query .= " WHERE u.creator_id = ".$userID;		$query .= " AND a.status != ".Accepted::STATUS_RELEASED;		$query .= " ORDER BY u.date_created DESC";		if($limit != null)			$query .= " LIMIT ".$limit;				$db = Db::instance();		$result = $db->lookup($query);		if(!mysql_num_rows($result)) return array();		$updates = array();		while($row = mysql_fetch_assoc($result))			$updates[$row['id']] = self::load($row['id']);		return $updates;			}			// --- only getters and setters below here --- //			public function getID()	{		return ($this->id);	}		public function setID($newID)	{		$this->id = $newID;		$this->modified = true;	}		public function getCreatorID()	{		return ($this->creatorID);	}		public function setCreatorID($newCreatorID)	{		$this->creatorID = $newCreatorID;		$this->modified = true;	}		public function getProjectID()	{		return ($this->projectID);	}		public function setProjectID($newProjectID)	{		$this->projectID = $newProjectID;		$this->modified = true;	}		public function getAcceptedID()	{		return ($this->acceptedID);	}		public function setAcceptedID($newAcceptedID)	{		$this->acceptedID = $newAcceptedID;		$this->modified = true;	}		public function getTitle() {		return ($this->title);	}		public function setTitle($newTitle) {		$this->title = $newTitle;		$this->modified = true;	}		public function getMessage()	{		return ($this->message);	}		public function setMessage($newMessage)	{		$this->message = $newMessage;		$this->modified = true;	}		public function getDateCreated()	{		return ($this->dateCreated);		$this->modified = true;	}		public function setDateCreated($newDateCreated)	{		$this->dateCreated = $newDateCreated;		$this->modified = true;	}		}