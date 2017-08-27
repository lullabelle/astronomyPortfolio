<?php

class Pagination {
	
  public $this_page;//current_page
  public $no_per_page;//per_page
  public $total_records;//total_count
  

// php constructor method. used to pass any parameters on object construction
  public function __construct($page=1, $no_per_page=20, $total_records=0){
  	$this->this_page = (int)$page;
	//LIMIT number returned to page mysql
    $this->no_per_page = (int)$no_per_page;
    $this->total_records = (int)$total_records;
  }
/* OFFSET takes into account the number of records that were displayed
on the previous page to calculate what number to start next page at. EG
10 items per page, page2 will start at 11, page 3 will start 21 so page 1 has 
offset of 10 */
  public function offset() {
    return ($this->this_page - 1) * $this->no_per_page;
  }

  public function total_pages() {
    return ceil($this->total_records/$this->no_per_page);
	}
	
  public function previous_page() {
    return $this->this_page - 1;//minus one page
  }
  
  public function next_page() {
    return $this->this_page + 1;// plus one page
  }

 public function is_first_page() {
	return $this->previous_page() >= 1 ? true : false;// checks if page is not the first page
 }

 public function is_last_page() {
	return $this->next_page() <= $this->total_pages() ? true : false;// checks if not the last page
 }


}

?>