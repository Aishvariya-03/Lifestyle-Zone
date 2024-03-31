<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Feedbacks</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
        <style>
            *{
                margin: 0px;
                padding: 0px;
                box-sizing: border-box;
            }
            a{
                text-decoration: none;
            }
            #feedbacks {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                width: 100%;
            }
            .feedbacks-heading{
                letter-spacing: 1px;
                margin: 30px 0px;
                padding: 10px 20px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .feedbacks-heading h1{
                font-size: 2.2rem;
                font-weight: 500;
                background-color: rgb(20, 161, 20);
                color: aliceblue;
                padding: 10px 20px;
            }
            .feedbacks-heading span{
                font-size: 2rem;
                color: rgb(19, 18, 18);
                margin-bottom: 10px;
                letter-spacing: 2px;
                text-transform: uppercase;
            }
            .feedbacks-box-container
            {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-evenly;
            }
            .feedbacks-box
            {
                width: 300px;
                box-shadow: 2px 2px 30px  rgba(0, 0, 0, 0.1);
                background-color: rgb(235, 227, 227);
                padding: 20px;
                margin: 15px;
                cursor: pointer;
            }
            img{
                width: 300px;
                height:300px;
                object-fit: cover;
                margin-right: 20px;
            }          
            .profile
            {
                display: flex;
                align-items: center;
            }
            .name-user
            {
                display: flex;
                flex-direction: column;
            }
            .name-user strong
            {
                color: #0d0d0d;
                font-size: 1.3rem;
                letter-spacing: 0.5px;
            }
            .reviews
            {
                color: rgb(56, 19, 19);
            }
            .box-top
            {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .client-comment p
            {
                font-size: 1.2rem;
                color: #0c0c0c;
            }
            /* Feedback Button Styles */
            #feedbackBtn {
                margin: 20px;
                padding: 15px 30px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 1.5rem;
                display: block;
                margin: auto;
            }

            #feedbackBtn:hover {
                background-color: #39783c;
            }
        </style>
    </head>
    <body>
        <section id="feedbacks">
            <div class="feedbacks-heading">
                <span>
                    Reviews
                </span>
                <h1>
                    Clients Says
                </h1>
            </div>
        
        <div class="feedbacks-box-container">
            <img src= "img1.jpg" alt="Client Image"/>
            <div class="feedbacks-box">
                <div class="box-top">

                    <!--profile-->
                    <div class="profile">
                        
                        <div class="name-user">
                            <strong>Priya Patel</strong>
                        </div>
                    </div>

                    <!---reviews-->
                    <div class="reviews">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="client-comment">
                    <p>Thanks to Herbal Life, I achieved my weight loss goals. Their products and expertly crafted workout plans made the journey enjoyable. Lost 12 kg and gained confidence!</p>
                </div>
            </div>

            <img src= "img2.jpg" alt="Client Image"/>
            <div class="feedbacks-box">
                <div class="box-top">

                    <!--profile-->
                    <div class="profile">
                        
                        <div class="name-user">
                            <strong>Rajesh Kumar</strong>
                        </div>
                    </div>

                    <!---reviews-->
                    <div class="reviews">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
                <div class="client-comment">
                    <p>Herbal Life products and their customized workout plans have transformed my life. I lost 15 kg in just 3 months. Feeling healthier and more energetic!</p>
                </div>
            </div>

            <img src= "img3.jpg" alt="Client Image"/>
            <div class="feedbacks-box">
                <div class="box-top">

                    <!--profile-->
                    <div class="profile">
                        
                        <div class="name-user">
                            <strong>Anand Singh</strong>
                        </div>
                    </div>

                    <!---reviews-->
                    <div class="reviews">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="client-comment">
                    <p>Herbal Life's nutritional guidance and effective workouts were a game-changer for me. I shed 18 kg in 4 months. Highly recommend their holistic approach to weight loss.</p>
                </div>
            </div>

            <img src= "img4.jpg" alt="Client Image"/>
            <div class="feedbacks-box">
                <div class="box-top">

                    <!--profile-->
                    <div class="profile">
                        
                        <div class="name-user">
                            <strong>Arjun Reddy</strong>
                        </div>
                    </div>

                    <!---reviews-->
                    <div class="reviews">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="client-comment">
                    <p>Herbal Life's comprehensive approach to fitness worked wonders for me. The products, along with personalized workout routines, helped me lose 20 kg in 5 months. Thrilled with the results!</p>
                </div>
            </div>

            <img src= "img5.jpg" alt="Client Image"/>
            <div class="feedbacks-box">
                <div class="box-top">

                    <!--profile-->
                    <div class="profile">
                        
                        <div class="name-user">
                            <strong>Neha Sharma</strong>
                        </div>
                    </div>

                    <!---reviews-->
                    <div class="reviews">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="client-comment">
                    <p>Herbal Life's products and fitness plans made weight loss feel effortless. I lost 10 kg and gained a new perspective on a healthy lifestyle. Grateful for the transformation!</p>
                </div>

            </div>
        </section>
        <button id="feedbackBtn"><a href="add_feedback.php" style="color: inherit; text-decoration: none;">Add Feedback</a></button>
        
        <script>
            /*Retrieve feedbacks from localStorage
            const existingFeedbacks = JSON.parse(localStorage.getItem('feedbacks')) || [];

            // Display existing feedbacks when the page loads
            displayFeedbacks(existingFeedbacks);*/

            function displayFeedbacks(feedbacks) 
            {
                const feedbacksContainer = document.querySelector('.feedbacks-box-container');

                feedbacksContainer.innerHTML = '';

                feedbacks.forEach(feedback => {
                    const feedbackBox = document.createElement('div');
                    feedbackBox.className = 'feedbacks-box';

                    const boxTop = document.createElement('div');
                    boxTop.className = 'box-top';

                    // ... (You can use similar logic to display other feedback details)

                    const clientComment = document.createElement('div');
                    clientComment.className = 'client-comment';
                    clientComment.innerHTML = `<p>${feedback.feedback}</p>`;

                    feedbackBox.appendChild(boxTop);
                    feedbackBox.appendChild(clientComment);

                    feedbacksContainer.appendChild(feedbackBox);
                });
            }
        </script>
    </body>
</html>