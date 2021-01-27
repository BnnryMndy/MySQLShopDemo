// ************************************************
// Shopping Cart API
// ************************************************
jQuery(document).ready(function($) {
    console.log('cart API on');

    var shoppingCart = (function() {
        // =============================
        // Private methods and propeties
        // =============================
        cart = [];

        // Constructor
        function Item(name, price, count, max_count, prod_id) {
            this.name = name;
            this.price = price;
            this.count = count;
            this.max_count = max_count;
            this.prod_id = prod_id;
        }

        // Save cart
        function saveCart() {
            sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
        }

        // Load cart
        function loadCart() {
            cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
        }
        if (sessionStorage.getItem("shoppingCart") != null) {
            loadCart();
        }


        // =============================
        // Public methods and propeties
        // =============================
        var obj = {};

        // Add to cart
        obj.addItemToCart = function(name, price, count, max_count, prod_id) {
                for (var item in cart) {
                    if (cart[item].name === name) {
                        cart[item].count++;
                        if (cart[item].count > cart[item].max_count) {
                            let buy_max = confirm("На складе сейчас только " + cart[item].max_count + ' товара "' + cart[item].name + '". Скупите весь товар? ');
                            if (buy_max == true) {
                                cart[item].count = cart[item].max_count;
                            } else {
                                cart[item].count = cart[item].max_count;
                            }

                        }
                        if (cart[item].count < 0) {
                            shoppingCart.removeItemFromCartAll(cart[item].name);
                        }
                        saveCart();
                        return;
                    }
                }

                var item = new Item(name, price, count, max_count, prod_id);
                cart.push(item);
                saveCart();
            }
            // Set count from item
        obj.setCountForItem = function(name, count) {
            for (var i in cart) {
                if (cart[i].name === name) {

                    cart[i].count = count;

                    if (cart[i].count > cart[i].max_count) {
                        let buy_max = confirm("На складе сейчас только " + cart[i].max_count + ' товара "' + cart[i].name + '". Скупите весь товар? ');
                        if (buy_max == true) {
                            cart[i].count = cart[i].max_count;
                        } else {
                            cart[i].count = 1;
                        }

                    }

                    if (cart[i].count < 0) {
                        shoppingCart.removeItemFromCartAll(cart[i].name);
                    }

                    break;
                }
            }
        };
        // Remove item from cart
        obj.removeItemFromCart = function(name) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart[item].count--;
                    if (cart[item].count === 0) {
                        cart.splice(item, 1);
                    }
                    break;
                }
            }
            saveCart();
        }

        obj.order = function post(path = 'order.php', parameters = cart) {
            if (typeof cart !== 'undefined' && cart.length > 0) {


                var form = $('<form></form>');

                form.attr("method", "post");
                form.attr("action", path);

                for (var item in cart) {
                    var field = $('<input></input>');

                    field.attr("type", "hidden");
                    field.attr("name", cart[item].prod_id);
                    field.attr("value", cart[item].count);

                    form.append(field);
                };

                // The form needs to be a part of the document in
                // order for us to be able to submit it.
                $(document.body).append(form);
                form.submit();
                obj.clearCart();
            } else {
                alert('Мы не можем принести то, не знаем что. Пожалуйтса, добавьте хотя бы один товар в корзину для оформления заказа');
            }
        }

        // Remove all items from cart
        obj.removeItemFromCartAll = function(name) {
            for (var item in cart) {
                if (cart[item].name === name) {
                    cart.splice(item, 1);
                    break;
                }
            }
            saveCart();
        }

        // Clear cart
        obj.clearCart = function() {
            cart = [];
            saveCart();
        }

        // Count cart 
        obj.totalCount = function() {
            var totalCount = 0;
            for (var item in cart) {
                totalCount += cart[item].count;
            }
            return totalCount;
        }

        // Total cart
        obj.totalCart = function() {
            var totalCart = 0;
            for (var item in cart) {
                totalCart += cart[item].price * cart[item].count;
            }
            return Number(totalCart.toFixed(2));
        }

        // List cart
        obj.listCart = function() {
            var cartCopy = [];
            for (i in cart) {
                item = cart[i];
                itemCopy = {};
                for (p in item) {
                    itemCopy[p] = item[p];

                }
                itemCopy.total = Number(item.price * item.count).toFixed(2);
                cartCopy.push(itemCopy)
            }
            return cartCopy;
        }

        // cart : Array
        // Item : Object/Class
        // addItemToCart : Function
        // removeItemFromCart : Function
        // removeItemFromCartAll : Function
        // clearCart : Function
        // countCart : Function
        // totalCart : Function
        // listCart : Function
        // saveCart : Function
        // loadCart : Function
        return obj;
    })();


    // *****************************************
    // Triggers / Events
    // ***************************************** 
    // Add item
    $('.add-to-cart').click(function(event) {
        console.log("item added");
        event.preventDefault();
        var name = $(this).data('name');
        var price = Number($(this).data('price'));
        var max_count = Number($(this).data('quantity'));
        var prod_id = Number($(this).data('prodid'));
        shoppingCart.addItemToCart(name, price, 1, max_count, prod_id);
        console.log("товар " + name + " c prod_id:" + prod_id + " был добавлен в корзину");
        displayCart();
    });

    $('.order-cart').click(function() {
        shoppingCart.order();
        displayCart();
    });

    // Clear items
    $('.clear-cart').click(function() {
        shoppingCart.clearCart();
        displayCart();
    });


    function displayCart() {
        var cartArray = shoppingCart.listCart();
        var output = "";
        for (var i in cartArray) {

            output += "<tr>" +
                "<td type='prod_name'>" + cartArray[i].name + "</td>" +
                "<td>" + cartArray[i].price + " руб</td>" +
                "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" + cartArray[i].name + ">-</button>" +
                "<input type='number' class='item-count form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>" +
                "<button class='plus-item btn btn-primary input-group-addon' data-name=" + cartArray[i].name + ">+</button></div></td>" +
                "<td><button class='delete-item btn btn-danger' data-name=" + cartArray[i].name + ">X</button></td>" +
                " = " +
                "<td>" + cartArray[i].total + "</td>" +

                "</tr>";
        }
        $('.show-cart').html(output);
        $('.total-cart').html(shoppingCart.totalCart());
        $('.total-count').html(shoppingCart.totalCount());
    }

    // Delete item button

    $('.show-cart').on("click", ".delete-item", function(event) {
        var name = $(this).data('name')
        shoppingCart.removeItemFromCartAll(name);
        displayCart();
    })


    // -1
    $('.show-cart').on("click", ".minus-item", function(event) {
            var name = $(this).data('name')
            shoppingCart.removeItemFromCart(name);
            displayCart();
        })
        // +1
    $('.show-cart').on("click", ".plus-item", function(event) {
        var name = $(this).data('name')
        shoppingCart.addItemToCart(name);
        displayCart();
    })

    // Item count input
    $('.show-cart').on("change", ".item-count", function(event) {
        var name = $(this).data('name');
        var count = Number($(this).val());
        shoppingCart.setCountForItem(name, count);
        displayCart();
    });
    displayCart();
});