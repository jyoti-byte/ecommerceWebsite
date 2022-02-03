var recentViewedProduct = {
    cookieSettings: {
            cookieName: "recentProduct",
            numofProducts: 2
    },
    setCookies: function(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    },
    getCookies: function(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
        return "";
    },
    prependArry: function (value, array) {
        var newArray = array.slice();
        newArray.unshift(value);
        return newArray;
    },
    productdetails: function(){
        var productName = document.querySelector('.product-info h5').innerText;
        // console.log(productName);
        var productPrice = document.querySelector('.product-info h6').innerText;
        // console.log(productPrice);
        var productImage = document.querySelector('.single-image img').src;
        // console.log(productImage);
        var productURL = window.location.href;
        // console.log(productURL);
        if(!this.getCookies(this.cookieSettings.cookieName)){
            var productInfo = [{'Name': productName,  'Price': productPrice, 'Image': productImage, 'Url': productURL }];
            // console.log(productInfo);
            this.setCookies(this.cookieSettings.cookieName, JSON.stringify(productInfo));
        } else {
            var productcookieinfo = this.getCookies(this.cookieSettings.cookieName);
            productcookieinfo = JSON.parse(productcookieinfo);
            if(productcookieinfo.length <= this.cookieSettings.numofProducts){
                var productInfo = {'Name': productName, 'Price': productPrice, 'Image': productImage, 'Url': productURL};
                var newProductArr = this.prependArry(productInfo, productcookieinfo);
                this.setCookies(this.cookieSettings.cookieName, JSON.stringify(newProductArr));
            }else {
                var recentArray = productcookieinfo.slice(0, -1);
                var productInfo = {'Name': productName, 'Price': productPrice, 'Image': productImage, 'Url': productURL};
                var newProductArr = this.prependArry(productInfo, recentArray);
                this.setCookies(this.cookieSettings.cookieName, JSON.stringify(newProductArr));
            }
            
        }
    },
    categorypage: function(){
        if(window.location.pathname != "/category.php"){
            jQuery('.product-section').after(`<div class="container recently-viewed mt-3 bg-light">
            <h2 class="text-center text-danger" style="font-family:'Abril Fatface', cursive;">Recently Viewed Products</h2>
            <div class="row recently-viewed-row p-5">
            </div>
            </div>`);

            var productcookieinfo = this.getCookies(this.cookieSettings.cookieName);
            productcookieinfo = JSON.parse(productcookieinfo);
            console.log(productcookieinfo);

            for(let i=0; i<productcookieinfo.length; i++) {
                console.log('working');

                jQuery('.recently-viewed-row').append(`<div class="col-4">
                <div class="recent-product-block mb-5">
                <div class="recent-product-block-thumbnail">
                    <a href="`+ productcookieinfo[i].Url +`" target="_blank"><img src="`+ productcookieinfo[i].Image +`" class="img-fluid mb-3" style="height:150px; width:400px"></a>
                <div class="recent-post-block-meta">
                    <h6 class="text-center">`+ productcookieinfo[i].Name +`</h6></a>  
                    <h5 class="text-center">`+ productcookieinfo[i].Price +`</h5>
                </div>
                </div>			
                </div>
                </div>`);
            }
        }
    },
    init: function(){
        if(jQuery("body .product-block").length){
            this.productdetails();
        }
        this.categorypage();
        
    }
}.init();
