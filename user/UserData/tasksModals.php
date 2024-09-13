<!-- Modal for Movies/Products-->
<div class="modal fade zoom_modal" id="TaskMovies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Order Information</h5>
        <button type="button" class="btn close_task" data-bs-dismiss="modal"><h1 class="rounded-circle">X</h1></button>
      </div>
      <!-- modal body starts here -->
      <div class="modal-body">
        <!-- flex-column this man -->
        <div class="history_card perform_task">
          <div class="history_card2">
            <div class="card_movie">
            <img src="../../admin/movies-img/<?php echo ($productData['product_img'] ?? '') ?>" alt="<?php echo ($productData['product_title'] ?? ''); ?>">
            </div>
              
              <div class="hcard_texts">
                  <p class="text-center movie_title text-light fs-5"><?php echo $productData['product_title'] ?? ''; ?></p>
                  
                  <p class="text-center text-light"><br>Creation Time:<br> <?php echo ($productData['created_date'] ?? '') ?></p>
              </div>
              <!-- grid this boy -->
    <div class="stars">
        <div class="star" data-value="1"></div>
        <div class="star" data-value="2"></div>
        <div class="star" data-value="3"></div>
        <div class="star" data-value="4"></div>
        <div class="star" data-value="5"></div>
    </div>
    <div class="rating-result">0/5</div>
    

    <!-- <form id="rating-form" action="process_rating.php" method="POST">
        <input type="hidden" id="rating-value" name="rating" value="0">
        <button type="submit">Submit Rating</button>
    </form> -->
          </div>
          <div class="history_card3">
              <!-- flex this boy -->
              <div class="card_boy">
                  <h5 class=""><span>Order Number</span></h5>
                  <h5><span>Order Amount</span></h5>
                  <h5><span>Income</span></h5>
               </div>
               <div class="card_boy2 text-light">
                  <h5><?php echo $productData['order_number'] ?? '' ?></h5>
                  <h5><?php echo $currency . ($productData['product_amount'] ?? '')?></h5>
                  <h5><?php echo $currency . ($newCommission ?? '' ) ?></h5>
               </div>
          </div>
      </div>
      </div>
      <form action="includes/process_task.php" method="POST">
        <!-- send hidden values here -->
        <input type="hidden" name="acctNo" value="<?php echo htmlspecialchars($AccountNo); ?>">
        <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
        <input type="hidden" name="balance" value="<?php echo htmlspecialchars($balance); ?>">
        <input type="hidden" name="product_id" value="<?php echo $productData['product_id']; ?>">
        <input type="hidden" name="product_title" value="<?php echo $productData['product_title']; ?>">
        <input type="hidden" name="product_img" value="<?php echo $productData['product_img']; ?>">
        <input type="hidden" name="product_amount" value="<?php echo $productData['product_amount']; ?>">
        <input type="hidden" name="commission" value="<?php echo $productData['commission']; ?>">
        <input type="hidden" name="level" value="<?php echo $productData['level']; ?>">
        <input type="hidden" name="order_number" value="<?php echo $productData['order_number']; ?>">
      <div class="modal-footer">
        <button type="submit" class="btn text-light text-center Perform_tasks_btn">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
                       <!-- start modal ends -->












<!-- Modal for Task Completed-->
<div class="modal fade" id="TaskCompleted" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">FilmSuppy</h5>
        <button type="button" class="btn close_task" data-bs-dismiss="modal"><h1 class="rounded-circle">X</h1></button>
      </div>
      <!-- modal body starts here -->
      <div class="modal-body">
        <!-- flex-column this man -->
        <div class="history_card perform_task">
          <div class="history_card2">
              
              <div class="hcard_texts">
                                    
                  <p class="text-center text-light">User has completed Rating, Please contact Customer Service to request a withdrawal and confirm the reset account for the day!</p>
              </div>
              <!-- grid this boy -->
    
          </div>
        
      </div>
      </div>
     
      <div class="modal-footer">
        <button type="submit" class="btn text-light text-center Perform_tasks_btn" data-bs-dismiss="modal">Confirm</button>
      </div>
   
    </div>
  </div>
</div>
                       <!-- start modal ends -->








<!-- Modal for No Tasks to Perform Regarding your Level-->
<div class="modal fade" id="Notupto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">FilmSuppy</h5>
        <button type="button" class="btn close_task" data-bs-dismiss="modal"><h1 class="rounded-circle">X</h1></button>
      </div>
      <!-- modal body starts here -->
      <div class="modal-body">
        <!-- flex-column this man -->
        <div class="history_card perform_task">
          <div class="history_card2">
              
              <div class="hcard_texts">
                                    
                  <p class="text-center text-light">This membership level requires <?php echo $Newproduct_count ?> movies to rate, kindly contact support for more movies.</p>
              </div>
              <!-- grid this boy -->
    
          </div>
        
      </div>
      </div>
     
      <div class="modal-footer">
        <button type="submit" class="btn text-light text-center Perform_tasks_btn" data-bs-dismiss="modal">Confirm</button>
      </div>
   
    </div>
  </div>
</div>
                       <!-- start modal ends -->

























<!-- Modal for No Tasks to Perform Regarding your Level-->
<div class="modal fade" id="NoTaskToPerform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">FilmSuppy</h5>
        <button type="button" class="btn close_task" data-bs-dismiss="modal"><h1 class="rounded-circle">X</h1></button>
      </div>
      <!-- modal body starts here -->
      <div class="modal-body">
        <!-- flex-column this man -->
        <div class="history_card perform_task">
          <div class="history_card2">
              
              <div class="hcard_texts">
                                    
                  <p class="text-center text-light">No task has been assinged to you. Please contact Customer Service</p>
              </div>
              <!-- grid this boy -->
    
          </div>
        
      </div>
      </div>
     
      <div class="modal-footer">
        <button type="submit" class="btn text-light text-center Perform_tasks_btn" data-bs-dismiss="modal">Confirm</button>
      </div>
   
    </div>
  </div>
</div>
                       <!-- start modal ends -->











<!-- Modal for Merge/Grand Order Movies/Products-->
<div class="modal fade" id="TaskMergeMovies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Order Information</h5>
        <button type="button" class="btn close_task" data-bs-dismiss="modal"><h1 class="rounded-circle">X</h1></button>
      </div>
      <!-- modal body starts here -->
      <div class="modal-body">
        <!-- flex-column this man -->
        <div class="history_card perform_task">
          <div class="history_card2">
              <img src="../../admin/movies-img/<?php echo ($mergeProductData['product_img'] ?? '') ?>" alt="<?php echo ($mergeProductData['product_title'] ?? ''); ?>">
              <div class="hcard_texts">
                  <p class="text-center movie_title text-light fs-5"><?php echo $mergeProductData['product_title'] ?? ''; ?></p>
                  
                  <p class="text-center text-light"><br>Creation Time:<br> <?php echo ($mergeProductData['created_date'] ?? '') ?></p>
              </div>
              <!-- grid this boy -->
    <div class="stars">
        <div class="star" data-value="1"></div>
        <div class="star" data-value="2"></div>
        <div class="star" data-value="3"></div>
        <div class="star" data-value="4"></div>
        <div class="star" data-value="5"></div>
    </div>
    <div class="rating-result">0/5</div>
    

    <!-- <form id="rating-form" action="process_rating.php" method="POST">
        <input type="hidden" id="rating-value" name="rating" value="0">
        <button type="submit">Submit Rating</button>
    </form> -->
          </div>
          <div class="history_card3">
              <!-- flex this boy -->
              <div class="card_boy">
                  <h5 class=""><span>Order Number</span></h5>
                  <h5><span>Order Amount</span></h5>
                  <h5><span>Income</span></h5>
               </div>
               <div class="card_boy2 text-light">
                  <h5><?php echo $mergeProductData['order_number'] ?? '' ?></h5>
                  <h5><?php echo $currency . ($mergeProductData['product_amount'] ?? '')?></h5>
                  <h5><?php echo $currency . ($newCommissionMerge ?? '' ) ?></h5>
               </div>
          </div>
      </div>
      </div>
      <form action="includes/process_merge.php" method="POST">
        <!-- send hidden values here -->
        <input type="hidden" name="acctNo" value="<?php echo htmlspecialchars($AccountNo); ?>">
        <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
        <input type="hidden" name="balance" value="<?php echo htmlspecialchars($balance); ?>">
        
        <input type="hidden" name="product_title" value="<?php echo $mergeProductData['product_title']; ?>">
        <input type="hidden" name="product_img" value="<?php echo $mergeProductData['product_img']; ?>">
        <input type="hidden" name="product_amount" value="<?php echo $mergeProductData['product_amount']; ?>">
        <input type="hidden" name="commission" value="<?php echo $mergeProductData['commission']; ?>">
        <input type="hidden" name="level" value="<?php echo $mergeProductData['level']; ?>">
        <input type="hidden" name="order_number" value="<?php echo $mergeProductData['order_number']; ?>">
      <div class="modal-footer">
        <button type="submit" class="btn text-light text-center Perform_tasks_btn">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
                       <!-- start modal ends -->