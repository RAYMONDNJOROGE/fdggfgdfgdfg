<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>captiveportal</title>

<body>
    <header>
        <div class="boxcontainer-header" style="margin-top: 10px;margin-bottom: 10px;">
                <h1 class="h1-header"><u style="color: rgb(12, 12, 219);">Raynger Networks</u></h1>
        </div>
    </header>
    <div class="boxcontainer">
        <div class="boxes">
            <h1 class="h1">1-Hour Vybz</h1>
            <h2 class="h2">@kes. 10</h2>
            <div>
                <button type="button" class="con-button" onclick="handlePayment(event, 10);">Connect</button>
            </div>
        </div>
        <div class="boxes">
            <h1 class="h1">3-Hour Vybz</h1>
            <h2 class="h2">@kes. 20</h2>
            <div>
                <button type="button" class="con-button" onclick="handlePayment(event, 20);">Connect</button>
            </div>
        </div>
        <div class="boxes">
            <h1 class="h1">1-Day Vybz</h1>
            <h2 class="h2">@kes. 50</h2>
            <div>
                <button type="button" class="con-button" onclick="handlePayment(event, 50);">Connect</button>
            </div>
        </div>
        <div class="boxes">
            <h1 class="h1">3-Day Vybz</h1>
            <h2 class="h2">@kes. 80</h2>
            <div>
                <button type="button" class="con-button" onclick="handlePayment(event, 80);">Connect</button>
            </div>
        </div>
        <div class="boxes">
            <h1 class="h1">1-Week Vybz</h1>
            <h2 class="h2">@kes. 190</h2>
            <div>
                <button type="button" class="con-button" onclick="handlePayment(event, 190);">Connect</button>
            </div>
        </div>
        <div class="boxes">
            <h1 class="h1">1-Month Vybz</h1>
            <h2 class="h2">@kes. 650</h2>
            <div>
                <button type="button" class="con-button" onclick="handlePayment(event, 650);">Connect</button>
            </div>
        </div>
    </div>

<!--This is the payment pop-up-->
    <div class="popup" id="popup1">
        <form autocomplete="off" onsubmit="return handlePaymentSubmit(event)">
           <div>
              <h1 class="h1-wrapper-pop">Enter your Safaricom Number to pay</h1>
           </div>
            <div>
                <input placeholder="e.g 2547123456789" class="input-pop" id="phone" required><br>
                    <button type="submit" class="button-pop" style="background-color: rgb(19, 94, 19);">
                        Pay
                    </button>
                   <button type="button" onclick="closePopup('popup1'); closePopup('popup2')" class="button-pop" style="background-color: rgb(110, 14, 14)" >
                    Cancel
                   </button>
            </div>
        </form> 
    </div>
    
    <div class="overlay" id="overlay"></div>
    
<!--This is the payment pop-up end-->

<!--This is the status pop-up-->
        <div id="popup2" class="popup2">
            <p id="message" class="error" style="font-weight: 600;"></p> 
            <button onclick="closePopup('popup2')" class="button-pop" style="background-color: rgb(164, 4, 4)">Ok</button>
        </div> 
    
<!--This is the status pop-up *2-->
            <div id="popup2" class="popup2">
            <p id="message" class="error" style="font-weight: 600;"></p> 
            <button onclick="closePopup('popup2')" class="button-pop" style="background-color: rgb(164, 4, 4)">Ok</button>
            </div>


<!--Payment notification proccessing-->
        <div id="popup3" class="popup">
        <p style="font-weight: 600; color: blue" class="error">Kindly Wait for the Payment Request on your Phone</p>   
        <div class="spinner"></div> <!-- Loading animation -->  
        </div>

<!--STK message-->
        <div id="popup4" class="popup">
        <p id="stkStatusMessage" style="font-weight: 600;" class="error"></p>
        </div>



        
    <div class="wrapper">
    <form autocomplete="off" onsubmit="return validatePhone2()">
    <div>
            <h1 class="h1-wrapper">Already have an active subscription?</h1>
    </div>

    <div>
            <h2 class="h2-wrapper">Enter your Safaricom number to Reconnect</h2>
    </div>
    <div>
    <input placeholder="254XXXXXXX" class="input1" id="phone2" required>
    </div>
    <div>
    <input type="submit" value="Reconnect" class="recon-button">
    </div>
    </form>
    </div>



    <div class="wrapper">
    <form>
    <div>
    <h1 class="h1-wrapper" style="color: rgb(12, 12, 219);"><u>Voucher Subscription</u></h1>
    </div>
    <div>
    <p class="note">Contact Admin for Voucher top-up</p>
    </div>
    <div style="margin-bottom: 10px; margin-top: 30px;">
    <input type="text" placeholder="Username" class="input1">
    </div>
    <div style="margin-top: 20px;">
    <input type="password" placeholder="Password" class="input1">
    </div>
    <div>
    <input type="submit" value="Connect" class="recon-button">
    </div>
    </form>
    </div>
     <footer class="boxcontainer-footer">
                <div>
                    <h1 class="h2-wrapper">Customer Care: (+254)717888783</h1>
                    <h1 class="h1-footer">&#169;Raynger Networks &#9830; All Rights Reserved</h1>
                </div>
    </footer>
    <div style="width: 100%; display: flex; justify-content: center; margin: 5px;">
        <p>
            <a href="https://jigsaw.w3.org/css-validator/check/referer">
                <img style="border:0;width:88px;height:31px"
                    src="https://jigsaw.w3.org/css-validator/images/vcss-blue"
                    alt="Valid CSS!" />
            </a>
        </p>
    </div>


                <style>
                    *{
    font-family: 'roboto', sans-serif;
}
body{
    background: rgb(0, 0, 0,0.8) url(bodybackground.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-blend-mode: darken;
    background-position: center;
    display: flex;
    flex-wrap: wrap;
    justify-content: center; 
}
.boxcontainer-header {
    display: flex;
    flex-wrap: wrap;
    text-align: center;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    background-color: white;
    background: transparent;
    border: 2px solid rgba(255,255,255,.2);
    backdrop-filter: blur(40px);
    box-shadow: 2px 2px 2px 2px rgb(34, 34, 46);
    border-radius: 5px;
    margin-bottom: 10px;
    margin-top: 20px;
} 
.boxcontainer-footer {
    display: flex;
    flex-wrap: wrap;
    text-align: center;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    padding-top: 0;
    background-color: white;
    background: transparent;
    border: 2px solid rgba(255,255,255,.2);
    backdrop-filter: blur(40px);
    box-shadow: 2px 2px 2px 2px rgb(34, 34, 46);
    border-radius: 5px;
    margin-bottom: 5px;
}
.boxcontainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 10px;
    margin-top: 20px;
}
.boxes{
    display: flex;
    justify-content: space-evenly;
    flex-direction: column;
    background-color: white;
    background: transparent;
    border: 2px solid rgba(255,255,255,.2);
    backdrop-filter: blur(40px);
    box-shadow: 2px 2px 2px 2px rgb(34, 34, 46);
    border-radius: 5px;
    text-align: center;
    justify-content: space-evenly;
    margin-left: auto;
    margin-right: auto;
    width: auto;
    height: auto;
}
.h1-header{
    margin: 0;
    font-size: 30px;
    font-weight: 700;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 5px;
    padding-bottom: 5px;
}
.h1-footer{
    color: rgb(172, 13, 13);
    font-size: 20px;
    font-weight: 600;
    padding-top: 8px;
    padding-bottom: 8px;
    margin: 0;
}
.h1{
    margin: 0;
    font-size: 22px;
    font-weight: 600;
    color: white;
}
.h1-wrapper{
    font-size: 30px;
    font-weight: 800;
    margin: 0;
    padding-bottom: 10px;
    padding-top: 10px;
}
.h2-wrapper{
    margin: 0;
    padding-bottom: 10px;
    padding-top: 10px;
    font-size: 26px;
    font-weight: 450;
    color: rgb(12, 12, 219);
}
.h2{
    margin: 0;
    font-size: 20px;
    margin-bottom: 20px;
    color: white;
    font-weight: 300;
}
.con-button{
    border: none;
    color: white;
    background-color: rgb(15, 73, 15);
    width: auto;
    height: auto;
    border: none;
    font-size: 14px;
    border-radius: 10px;
    margin-bottom: 10px;
    padding-left: 20px; padding-right: 20px;
    padding-top: 10px; padding-bottom: 10px;
}
.con-button:hover{
    cursor: pointer;
}
.con-button:active{
    background-color: rgb(19, 18, 51);
}
.wrapper{
    width: 340px;
    height: auto;
    color: white;
    background-color: white;
    background: transparent;
    border: 2px solid rgba(255,255,255,.2);
    backdrop-filter: blur(40px);
    box-shadow: 2px 2px 2px 2px rgb(34, 34, 46);
    border-radius: 5px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    margin-bottom: 20px;
}
.recon-button{
    border: none;
    color: white;
    background-color: rgb(15, 73, 15);
    width: auto;
    height: auto;
    border: none;
    font-size: 20px;
    border-radius: 10px;
    margin: 20px;
    padding-left: 20px; padding-right: 20px;
    padding-top: 10px; padding-bottom: 10px;
    
}
.recon-button:hover{
    cursor: pointer;
}
.recon-button:active{
    background-color: rgb(19, 18, 51);
}
.input1{
    width: 80%;
    height: 50px;
    border: none;
    text-align: center;
    border-radius: 5px;
    font-size: 20px;
}
.note{
    font-size: 15px;
}
@media (min-width: 200px) {
    .h1-header{
        font-size: 30px;
    }
    .h1{
        font-size: 20px;
    }
    .h1-wrapper{
        font-size: 30px;
    }
    .h2-wrapper{
        font-size: 26px;
    }
    .h1-footer{
        font-size: 20px;
    }
    .wrapper{
        width: 280px;
    }
    .h2{
        font-size: 16px;
    }
    .boxes{
        width: 180px;
    }
    .boxcontainer{
        max-width: 200px;
    }
    .con-button{
        font-size: 14px;
    }
    .recon-button{
        font-size: 16px;
    }
    .input1{
        font-size: 16px;
    }
    .note{
        font-size: 18px;
    }
}
@media (min-width: 300px) {
    .h1-header{
        font-size: 40px;
    }
    .h1{
        font-size: 23px;
    }
    .h1-wrapper{
        font-size: 34px;
    }
    .h2-wrapper{
        font-size: 28px;
    }
    .h1-footer{
        font-size: 22px;
    }
    .wrapper{
        width: 260px;
    }
    .h2{
        font-size: 18px;
    }
    .boxes{
        width: 125px;
    }
    .boxcontainer{
        max-width: 300px;
    }
    .con-button{
        font-size: 14px;
    }
    .recon-button{
        font-size: 20px;
    }
    .input1{
        font-size: 19px;
    }
    .note{
        font-size: 22px;
    }
}
@media (min-width: 350px) {
    .h1-header{
        font-size: 43px;
    }
    .h1{
        font-size: 21px;
    }
    .h1-wrapper{
        font-size: 39px;
    }
    .h2-wrapper{
        font-size: 30px;
    }
    .h1-footer{
        font-size: 24px;
    }
    .wrapper{
        width: 300px;
    }
    .h2{
        font-size: 19px;
    }
    .boxes{
        width: 145px;
    }
    .boxcontainer{
        max-width: 350px;
    }
    .con-button{
        font-size: 16px;
    }
    .recon-button{
        font-size: 20px;
    }
    .input1{
        font-size: 22px;
    }
    .note{
        font-size: 24px;
    }
}

@media (min-width: 475px) {
    .h1-header{
        font-size: 45px;
    }
    .h1{
        font-size: 30px;
    }
    .h1-wrapper{
        font-size: 45px;
    }
    .h2-wrapper{
        font-size: 38px;
    }
    .h1-footer{
        font-size: 26px;
    }
    .wrapper{
        width: 500px;
    }
    .h2{
        font-size: 25px;
    }
    .boxes{
        width: 210px;
    }
    .boxcontainer{
        max-width: 475px;
    }
    .con-button{
        font-size: 18px;
    } 
    .recon-button{
        font-size: 25px;
    } 
    .input1{
        font-size: 24px;
    } 
    .note{
        font-size: 28px;
    }
}


@media (min-width: 640px) {
    .h1-header{
        font-size: 50px;
    }
    .h1{
        font-size: 35px;
    }
    .h1-wrapper{
        font-size: 45px;
    }
    .h2-wrapper{
        font-size: 40px;
    }
    .h1-footer{
        font-size: 28px;
    }
    .wrapper{
        width: 600px;
    }
    .h2{
        font-size: 30px;
    }
    .boxes{
        width: 240px;
    }
    .boxcontainer{
        max-width: 640px;
    }
    .con-button{
        font-size: 20px;
    } 
    .recon-button{
        font-size: 28px;
    }
    .input1{
        font-size: 26px;
    }
    .note{
        font-size: 32px;
    }
}


@media (min-width: 768px) {
    .h1-header{
        font-size: 57px;
    }
    .h1{
        font-size: 45px;
    }
    .h1-wrapper{
        font-size: 50px;
    }
    .h2-wrapper{
        font-size: 45px;
    }
    .h1-footer{
        font-size: 30px;
    }
    .wrapper{
        width: 700px;
    }
    .h2{
        font-size: 35px;
    }
    .boxes{
        width: 260px;
    }
    .boxcontainer{
        max-width: 768px;
    }
    .con-button{
        font-size: 22px;
    } 
    .recon-button{
        font-size: 35px;
    }
    .input1{
        font-size: 28px;
    }
    .note{
        font-size: 35px;
    }
}
@media (min-width: 1024px) {
    .h1-header{
        font-size: 63px;
    }
    .h1{
        font-size: 50px;
    }
    .h1-wrapper{
        font-size: 45px;
    }
    .h2-wrapper{
        font-size: 38px;
    }
    .h1-footer{
        font-size: 32px;
    }
    .wrapper{
        width: 600px;
    }
    .h2{
        font-size: 40px;
    }
    .boxes{
        width: 290px;
    }
    .boxcontainer{
        max-width: 1024px;
    }
    .con-button{
        font-size: 24px;
    }
    .recon-button{
        font-size: 35px;
    }
    .input1{
        font-size: 30px;
    }
    .note{
        font-size: 38px;
    }
}
@media (min-width: 1280px) {
    .h1-header{
        font-size: 67px;
    }
    .h1{
        font-size: 50px;
    }
    .h1-wrapper{
        font-size: 50px;
    }
    .h2-wrapper{
        font-size: 45px;
    }
    .h1-footer{
        font-size: 34px;
    }
    .wrapper{
        width: 700px;
    }
    .h2{
        font-size: 45px;
    }
    .boxes{
        width: 330px;
    }
    .boxcontainer{
        max-width: 1280px;
    }
    .con-button{
        font-size: 26px;
    }
    .recon-button{
        font-size: 31px;
    }
    .input1{
        font-size: 30px;
    }
    .note{
        font-size: 41px;
    }
}
@media (min-width: 1536px) {
    .h1-header{
        font-size: 70px;
    }
    .h1{
        font-size: 55px;
    }
    .h1-wrapper{
        font-size: 46px;
    }
    .h2-wrapper{
        font-size: 42px;
    }
    .h1-footer{
        font-size: 36px;
    }
    .wrapper{
        width: 750px;
    }
    .h2{
        font-size: 50px;
    }
    .boxes{
        width: 380px;
    }
    .boxcontainer{
        max-width: 1536px;
    }
    .con-button{
    font-size: 28px;
    }
    .recon-button{
        font-size: 32px;
    }
    .input1{
        font-size: 30px;
    }
    .note{
        font-size: 43px;
    }
}
@media (min-width: 2000px) {
    .h1-header{
        font-size: 80px;
    }
    .h1{
        font-size: 70px;
    }
    .h1-wrapper{
        font-size: 60px;
    }
    .h2-wrapper{
        font-size: 65px;
    }
    .h1-footer{
        font-size: 45px;
    }
    .wrapper{
        width: 1550px;
    }
    .h2{
        font-size: 70px;
    }
    .boxes{
        width: 480px;
    }
    .boxcontainer{
        max-width: 2000px;
    }
    .con-button{
    font-size: 30px;
    }
    .recon-button{
        font-size: 32px;
    }
    .input1{
        font-size: 30px;
    }
    .note{
        font-size: 45px;
    }
}
.wrapper-pop{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
    height: auto;
    justify-content: center;
    text-align: center;
    background-color: white;
    border-radius: 10px;
    z-index: 1000;
}
.wrapper-pop2{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
    height: auto;
    justify-content: center;
    text-align: center;
    background-color: white;
    border-radius: 10px;
}
.h1-wrapper-pop2 {
    color: rgb(12, 12, 219);
    padding: 10px;
    margin-top: 20px;
    font-size: 30px;
    border-radius: 4px;
}
.h1-wrapper-pop{
   color: rgb(12, 12, 219);
   font-size: 20px;
   font-weight: 600;
   margin-top: 5px;
   margin-bottom: 5px;
   margin-left: auto;
   margin-right: auto;
   padding-left: 5px;
   padding-right: 5px;
}
.input-pop{
    width: 70%;
    height: 32px;
    text-align: center;
    font-size: 27px;
    border: 2px black solid;
    border-radius: 5px;
    margin: 10px;
}
.button-pop{
    width: 150px;
    height: 32px;
    margin-left: auto;
    margin-right: auto;
    margin: 10px;
    color: white;
    border: none;
    font-size: 25px;
    border-radius: 10px;
}
.button-pop:hover{
    opacity: 0.7;
    cursor: pointer;
}

@media (min-width: 100px){
    .wrapper-pop{
        width: 170px;
    }
    .h1-wrapper-pop{
        font-size: 20px;
    }
    .input-pop{
        height: 32px;
        font-size: 27px;
    }  
    .button-pop{
        width: 150px;
        height: 32px;
        font-size: 25px;
    }
}
@media (min-width: 200px){
    .wrapper-pop{
        width: 180px;
    }
    .h1-wrapper-pop{
        font-size: 24px;
    }
    .input-pop{
        height: 32px;
        font-size: 27px;
    }  
    .button-pop{
        width: 170px;
        height: 33px;
        font-size: 25px;
    }
}
 @media (min-width: 250px){
        .wrapper-pop{
            width: 240px;
        }
        .h1-wrapper-pop{
            font-size: 24px;
        }
        .input-pop{
            height: 32px;
            font-size: 27px;
        }  
        .button-pop{
            width: 170px;
            height: 32px;
            font-size: 25px;
        }
    }
@media (min-width: 300px){
        .wrapper-pop{
            width: 280px;
        }
        .h1-wrapper-pop{
            font-size: 25px;
        }
        .input-pop{
            height: 32px;
            font-size: 27px;
        }  
        .button-pop{
            width: 170px;
            height: 35px;
            font-size: 25px;
        }
}
@media (min-width: 350px){
    .wrapper-pop{
        width: 350px;
    }
    .h1-wrapper-pop{
        font-size: 28px;
    }
    .input-pop{
        height: 35px;
        font-size: 30px;
    }
    .button-pop{
        width: 190px;
        height: 40px;
        font-size: 26px;
    }
}
@media (min-width: 475px){
    .wrapper-pop{
        width: 475px;
    }
    .h1-wrapper-pop{
        font-size: 35px;
    }
    .input-pop{
        height: 35px;
        font-size: 38px;
    }
    .button-pop{
        width: 240px;
        height: 40px;
        font-size: 27px;
    }
}
@media (min-width: 640px){
    .wrapper-pop{
        width: 640px;
    }
    .h1-wrapper-pop{
        font-size: 40px;
    }
    .input-pop{
        height: 40px;
        font-size: 32px;
    }
    .button-pop{
        width: 240px;
        height: 42px;
        font-size: 28px;
    }
}
@media (min-width: 768px){
    .wrapper-pop{
        width: 768px;
    }
    .h1-wrapper-pop{
        font-size: 42px;
    }
    .input-pop{
        height: 42px;
        font-size: 36px;
    }
    .button-pop{
        width: 260px;
        height: 45px;
        font-size: 29px;
    }
}
@media (min-width: 1024px){
    .wrapper-pop{
        width: 1024px;
    }
    .h1-wrapper-pop{
        font-size: 45px;
    }
    .input-pop{
        height: 45px;
        font-size: 38px;
    }
    .button-pop{
        width: 270px;
        height: 50px;
        font-size: 30px;
    }

}
@media (min-width: 1280px){
    .wrapper-pop{
        width: 1280px;
    }
    .h1-wrapper-pop{
        font-size: 52px;
    }
    .input-pop{
        height: 54px;
        font-size: 40px;
    }
    .button-pop{
        width: 280px;
        height: 55px;
        font-size: 31px;
    }
}
@media (min-width: 1536px){
    .wrapper-pop{
        width: 1536px;
    }
    .h1-wrapper-pop{
        font-size: 60px;
    }
    .input-pop{
        height: 60px;
        font-size: 43px;
    }
    .button-pop{
        width: 300px;
        height: 60px;
        font-size: 32px;
    }
}
@media (min-width: 2000px){
    .wrapper-pop{
        width: 2000px;
    }
    .h1-wrapper-pop{
        font-size: 22px;
    }
    .input-pop{
        height: 30px;
        font-size: 46px;
    }
    .button-pop{
        width: 300px;
        height: 60px;
        font-size: 33px;
    }
}
.popup-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}



.overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(0, 0, 0, 0.6);
    display: none;
    transition: opacity 0.3s ease;
    z-index: 800;
}
.active {
    display: block;
}
.popup{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.95);
    visibility: hidden;
    height: auto;
    width: 350px;
    justify-content: center;
    text-align: center;
    background-color: white;
    transition: opacity 0.3s ease, transform 0.4s ease;
    border-radius: 10px;
    z-index: 900;
    border: 5px rgb(4, 4, 156) solid;
}
.popup2{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.95);
    visibility: hidden;
    height: auto;
    width: 350px;
    justify-content: center;
    text-align: center;
    background-color: white;
    transition: opacity 0.3s ease, transform 0.4s ease;
    border-radius: 10px;
    z-index: 1000;
    border: 10px red solid;
    padding: 10px;
}
.spinner {
    margin: 10px auto;
    width: 40px;
    height: 40px;
    border: 5px solid rgba(0, 0, 255, 0.2);
    border-top-color: #0000ff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }
  
  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }
.active.overlay {
    opacity: 1;
    visibility: visible;
}
.active.popup {
    opacity: 1;
    visibility: visible;
    transform: translate(-50%, -50%) scale(1);
  }
  .active.popup2 {
    opacity: 1;
    visibility: visible;
    transform: translate(-50%, -50%) scale(1);
  }
.h1-pop.popup{
   color: rgb(12, 12, 219);
   font-size: 22px;
   font-weight: 600;
   margin-top: 5px;
   margin-bottom: 5px;
   margin-left: auto;
   margin-right: auto;
   padding-left: 5px;
   padding-right: 5px;
}
.input-pop{
    width: 70%;
    height: 30px;
    text-align: center;
    font-size: 20px;
    border: 2px black solid;
    border-radius: 5px;
    margin: 10px;
}
.button-pop{
    width: 100px;
    height: 40px;
    margin-top: 20px;
    color: white;
    border: none;
    font-size: 20px;
    border-radius: 10px;
}
.button-pop:hover{
    opacity: 0.7;
    cursor: pointer;
}
.error {
    color: rgb(196, 7, 7);
    transition: opacity 0.2s ease-in-out;
    font-size: 30px;
  }
  @media (min-width: 140px){
    .popup,.popup2{
        width: 135px;
    }
    .h1-pop.popup{
        font-size: 22px;
    }
    .input-pop{
        height: 39px;
        font-size: 21px;
    }  
    .button-pop{
        width: 110px;
        height: 33px;
        font-size: 20px;
    }
}
@media (min-width: 200px){
    .popup,.popup2{
        width: 270px;
    }
    .h1-pop.popup{
        font-size: 26px;
    }
    .input-pop{
        height: 39px;
        font-size: 25px;
    }  
    .button-pop{
        width: 140px;
        height: 33px;
        font-size: 27px;
    }
}
@media (min-width: 350px){
    .popup,.popup2{
        width: 350px;
    }
    .h1-pop.popup{
        font-size: 28px;
    }
    .input-pop{
        height: 40px;
        font-size: 30px;
    }
    .button-pop{
        width: 140px;
        height: 35px;
        font-size: 25px;
    }
}
@media (min-width: 475px){
    .popup,.popup2{
        width: 475px;
    }
    .h1-pop.popup{
        font-size: 35px;
    }
    .input-pop{
        height: 35px;
        font-size: 38px;
    }
    .button-pop{
        width: 200px;
        height: 40px;
        font-size: 30px;
    }
}
@media (min-width: 640px){
    .popup,.popup2{
        width: 640px;
    }
    .h1-pop.popup{
        font-size: 40px;
    }
    .input-pop{
        height: 40px;
        font-size: 32px;
    }
    .button-pop{
        width: 240px;
        height: 42px;
        font-size: 31px;
    }
}
@media (min-width: 768px){
    .popup,.popup2{
        width: 768px;
    }
    .h1-pop.popup{
        font-size: 42px;
    }
    .input-pop{
        height: 42px;
        font-size: 36px;
    }
    .button-pop{
        width: 260px;
        height: 45px;
        font-size: 33px;
    }
}
@media (min-width: 1024px){
    .popup,.popup2{
        width: 1024px;
    }
    .h1-pop.popup{
        font-size: 45px;
    }
    .input-pop{
        height: 45px;
        font-size: 38px;
    }
    .button-pop{
        width: 270px;
        height: 50px;
        font-size: 35px;
    }

}
@media (min-width: 1280px){
    .popup,.popup2{
        width: 1280px;
    }
    .h1-pop.popup{
        font-size: 52px;
    }
    .input-pop{
        height: 54px;
        font-size: 40px;
    }
    .button-pop{
        width: 280px;
        height: 55px;
        font-size: 37px;
    }
}
@media (min-width: 1536px){
    .popup,.popup2{
        width: 1536px;
    }
    .h1-pop.popup{
        font-size: 60px;
    }
    .input-pop{
        height: 60px;
        font-size: 43px;
    }
    .button-pop{
        width: 300px;
        height: 60px;
        font-size: 40px;
    }
}
@media (min-width: 2000px){
    .popup,.popup2{
        width: 2000px;
    }
    .h1-pop.popup{
        font-size: 22px;
    }
    .input-pop{
        height: 30px;
        font-size: 46px;
    }
    .button-pop{
        width: 300px;
        height: 60px;
        font-size: 40px;
    }
}

                </style>
    


<!--Java Script-->



                <script>
                    //open pop ups
function openPopup(id) {
    document.getElementById("overlay").classList.add("active");
  
    // Activate the selected popup
    const popupToOpen = document.getElementById(id);
    if (popupToOpen) {
      popupToOpen.classList.add("active");
    }
  }
  
  function closePopup(id) {
    // Close the specific popup (if needed)
    const popupToClose = document.getElementById(id);
    if (popupToClose) {
      popupToClose.classList.remove("active");
    }
  
    // Close all other popups too
    document.querySelectorAll(".popup, .popup2").forEach(popup => {
      popup.classList.remove("active");
    });
  
    // Hide overlay
    document.getElementById("overlay").classList.remove("active");
  
    // Clear form input and messages
    const phoneInput = document.getElementById("phone");
    if (phoneInput) phoneInput.value = "";
  
    const message = document.getElementById("message");
    if (message) message.textContent = "";
  
    const stkStatusMessage = document.getElementById("stkStatusMessage");
    if (stkStatusMessage) stkStatusMessage.textContent = "";
  }




//check if phone number is valid
let selectedAmount = 0;

// Triggered by fixed-amount button
function handlePayment(event, amount) {
  event.preventDefault();
  selectedAmount = amount; // Store selected amount
  openPopup('popup1');     // Show phone input form
}

// Form submission from popup1
async function handlePaymentSubmit(event) {
  event.preventDefault();

  const phone = document.getElementById("phone").value.trim();
  const message = document.getElementById("message");

  if (!/^254\d*$/.test(phone)) {
    message.textContent = "Error! Use Format 254XXXXXXXXX";
    openPopup('popup2');
    return;
  }

  openPopup('popup3'); // Loading spinner
  

  try {
    const res = await fetch("pay.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `phone=${encodeURIComponent(phone)}&amount=${selectedAmount}&submit=1`
    });

    const data = await res.json();
    console.log("STK Push Response:", data);


    setTimeout(() => {
      closePopup('popup3');
      openPopup('popup4');
      document.getElementById("stkStatusMessage").textContent =
        data.ResponseCode === "0"
          ? "Payment Request Sent Successfully!. Please Enter your M-pesa PIN"
          : `Failed: ${data.errorMessage || "Unknown error"}`;

      setTimeout(() => {
        closePopup('popup4');
      }, 3000);
    }, 1000);

  } catch (error) {
    console.error("STK Push failed:", error);

    setTimeout(() => {
      closePopup('popup3');
      openPopup('popup4');
      document.getElementById("stkStatusMessage").textContent = "NETWORK ERROR❌ . Please Try Again!";

      setTimeout(() => {
        closePopup('popup4');
      }, 4000);
    }, 1000);
  }
}


  
  
//check if phone number is valid*2

function validatePhone2() {
    const phone = document.getElementById("phone2").value.trim();
    const message = document.getElementById("message");
  
    if (/^254\d{9}$/.test(phone)) {
      // ✅ Valid number: don't show popup2, allow form to submit
      return true;
    } else {
      // ❌ Invalid number: show message in popup2 and prevent form submit
      message.textContent = "Error! Please Enter your phone number in the Format 254XXXXXXXXX";
      openPopup('popup2');
      return false;
    }
  }
                </script>
   
</body>
</html>
