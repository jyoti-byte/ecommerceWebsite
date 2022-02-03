var cart = {
    cookieSettings: {
            cookieName: "cart",
            numofBlogs: 4
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
    cartdetails: function(){
        jQuery("addtocart").on('click', function() {
            var productName = document.querySelector('.card-title').innerText;
            var quantity    = document.querySelector('.form-control').innerText;
            if(!this.getCookies(this.cookieSettings.cookieName)){
                var productInfo = [{'product_name': productName, 'qty': quantity}];
                this.setCookies(this.cookieSettings.cookieName, JSON.stringify(productInfo));
            } else {
                var productcookieinfo = this.getCookies(this.cookieSettings.cookieName);
                productcookieinfo = JSON.parse(productcookieinfo);
                if(productcookieinfo.length <= this.cookieSettings.numofBlogs){
                    var productInfo = {'product_name': productName, 'qty': quantity};
                    var newProductArr = this.prependArry(productInfo, productcookieinfo);
                    this.setCookies(this.cookieSettings.cookieName,JSON.stringify(newProductArr));
                }
             }

        })
        
    },
    bloginhomepage: function(){
        if(window.location.pathname == "/cart.php"){
            jQuery('body').append(`<div class="container recently-viewed">
            <div class="row recently-viewed-row">
            </div>
            </div>`)

            var productcookieinfo = this.getCookies(this.cookieSettings.cookieName);
            productcookieinfo = JSON.parse(productcookieinfo);

            for(let i=0; i<productcookieinfo.length; i++) {

                jQuery('.recently-viewed-row').append(`<div class="col-4">
                <div class="recent-post-block">
                <div class="recent-post-block-thumbnail">
                <h4>"`+ productcookieinfo[i].productName +`"></h4>
                </div>
                <div class="recent-post-block-meta">
                <h4>"`+ productcookieinfo[i].quantity +`"></h4>
                // <h6>`+ productcookieinfo[i].title +`</h6>
                </div>			
                </div>
                </div>`)
            }
        }
    },
    init: function(){
        if(jQuery("body.post-template-default").length){
            this.cartdetails()
        }
        this.bloginhomepage();
        
    }
}.init();
