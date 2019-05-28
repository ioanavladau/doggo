<?php 
    $sGreyBodyClass = "class='grey-bg'";
    
    session_start();
    $sUserEmail = $_SESSION['sEmail'];

    $iBookingFk = $_GET['bookingfk'] ?? '';
    $iDogsitterfk = $_GET['dogsitterfk'] ?? '';

    $sHeaderLink = "<script> window.sUserEmail = '$sUserEmail'; window.iBookingFk = '$iBookingFk'; window.iDogsitterfk = '$iDogsitterfk'</script>";
    
    require_once 'top-logged-in.php';
    // $sUserEmail = $_SESSION['sEmail'];

?>


<div class="container contents-centered">
    <div class="card card-with-a-title ">
        <div class="card-title">
            Leave a review 
        </div>
        <form id="frmLeaveAReview" enctype="multipart/form-data">
            <div>
                <label for="txtReview">Your review</label>
                <textarea name="txtReview" id="txtReview"></textarea><br>
            </div>

            <h5>Rate the walk</h5>
            <div class="review-stars">
                <div class="review-star" data-star="1">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 27.3 26.1" style="enable-background:new 0 0 27.3 26.1;" xml:space="preserve">
                    <g>
                        <path class="st0" d="M0.7,11.8L6,15.6c0.6,0.4,0.9,1.2,0.6,1.9l-2,6.2c-0.5,1.6,1.3,2.9,2.7,1.9l5.3-3.9c0.6-0.4,1.4-0.4,2,0
                            l5.3,3.9c1.4,1,3.2-0.3,2.7-1.9l-2-6.2c-0.2-0.7,0-1.5,0.6-1.9l5.3-3.9c1.4-1,0.7-3.1-1-3.1H19c-0.8,0-1.4-0.5-1.6-1.2l-2-6.2
                            c-0.5-1.6-2.8-1.6-3.3,0l-2,6.2C9.7,8.2,9.1,8.6,8.3,8.6H1.7C0.1,8.6-0.6,10.8,0.7,11.8z"/>
                    </g>
                    </svg>
                </div>
                <div class="review-star" data-star="2">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 27.3 26.1" style="enable-background:new 0 0 27.3 26.1;" xml:space="preserve">
                    <g>
                        <path class="st0" d="M0.7,11.8L6,15.6c0.6,0.4,0.9,1.2,0.6,1.9l-2,6.2c-0.5,1.6,1.3,2.9,2.7,1.9l5.3-3.9c0.6-0.4,1.4-0.4,2,0
                            l5.3,3.9c1.4,1,3.2-0.3,2.7-1.9l-2-6.2c-0.2-0.7,0-1.5,0.6-1.9l5.3-3.9c1.4-1,0.7-3.1-1-3.1H19c-0.8,0-1.4-0.5-1.6-1.2l-2-6.2
                            c-0.5-1.6-2.8-1.6-3.3,0l-2,6.2C9.7,8.2,9.1,8.6,8.3,8.6H1.7C0.1,8.6-0.6,10.8,0.7,11.8z"/>
                    </g>
                    </svg>
                </div>
                <div class="review-star" data-star="3">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 27.3 26.1" style="enable-background:new 0 0 27.3 26.1;" xml:space="preserve">
                    <g>
                        <path class="st0" d="M0.7,11.8L6,15.6c0.6,0.4,0.9,1.2,0.6,1.9l-2,6.2c-0.5,1.6,1.3,2.9,2.7,1.9l5.3-3.9c0.6-0.4,1.4-0.4,2,0
                            l5.3,3.9c1.4,1,3.2-0.3,2.7-1.9l-2-6.2c-0.2-0.7,0-1.5,0.6-1.9l5.3-3.9c1.4-1,0.7-3.1-1-3.1H19c-0.8,0-1.4-0.5-1.6-1.2l-2-6.2
                            c-0.5-1.6-2.8-1.6-3.3,0l-2,6.2C9.7,8.2,9.1,8.6,8.3,8.6H1.7C0.1,8.6-0.6,10.8,0.7,11.8z"/>
                    </g>
                    </svg>
                </div>
                <div class="review-star" data-star="4">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 27.3 26.1" style="enable-background:new 0 0 27.3 26.1;" xml:space="preserve">
                    <g>
                        <path class="st0" d="M0.7,11.8L6,15.6c0.6,0.4,0.9,1.2,0.6,1.9l-2,6.2c-0.5,1.6,1.3,2.9,2.7,1.9l5.3-3.9c0.6-0.4,1.4-0.4,2,0
                            l5.3,3.9c1.4,1,3.2-0.3,2.7-1.9l-2-6.2c-0.2-0.7,0-1.5,0.6-1.9l5.3-3.9c1.4-1,0.7-3.1-1-3.1H19c-0.8,0-1.4-0.5-1.6-1.2l-2-6.2
                            c-0.5-1.6-2.8-1.6-3.3,0l-2,6.2C9.7,8.2,9.1,8.6,8.3,8.6H1.7C0.1,8.6-0.6,10.8,0.7,11.8z"/>
                    </g>
                    </svg>
                </div>
                <div class="review-star" data-star="5">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 27.3 26.1" style="enable-background:new 0 0 27.3 26.1;" xml:space="preserve">
                    <g>
                        <path class="st0" d="M0.7,11.8L6,15.6c0.6,0.4,0.9,1.2,0.6,1.9l-2,6.2c-0.5,1.6,1.3,2.9,2.7,1.9l5.3-3.9c0.6-0.4,1.4-0.4,2,0
                            l5.3,3.9c1.4,1,3.2-0.3,2.7-1.9l-2-6.2c-0.2-0.7,0-1.5,0.6-1.9l5.3-3.9c1.4-1,0.7-3.1-1-3.1H19c-0.8,0-1.4-0.5-1.6-1.2l-2-6.2
                            c-0.5-1.6-2.8-1.6-3.3,0l-2,6.2C9.7,8.2,9.1,8.6,8.3,8.6H1.7C0.1,8.6-0.6,10.8,0.7,11.8z"/>
                    </g>
                    </svg>
                </div>
            </div>
            <button class="yellow-btn submit-review">Submit review</button>
            
        </form>
    </div>
</div>



<?php 
    $sLinktoScript = '<script src="js/review-form.js"></script>';
    require_once 'bottom.php'; ?>