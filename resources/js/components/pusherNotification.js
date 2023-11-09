export default
console.log('pusher')
    Pusher.logToConsole = true;
    
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('div[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('div[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var ulElement = document.getElementById("scrollable-container");

    // reset notifications count to 0
    function resetToZero() {
        notificationsCount = 0
        notificationsCountElem.attr('data-count', notificationsCount)
        notificationsWrapper.find('.notif-count').text(notificationsCount)
        notificationsWrapper.show()
    } 

    // create pusher object
    var pusher = new Pusher('d0608be6bc44e0f552bf', {
        cluster: 'mt1'
        // encrypted:true
        // authEndpoint: '/broadcasting/auth'
    });

    // Subscribe to the channel we specified in our Laravel Event
    yourUserId = document.getElementById('userId').value
    const channelName = 'user.' + yourUserId;
    var channel = pusher.subscribe(channelName);

    // Bind a function to a Event (the full Laravel class)
    channel.bind('my-event', function (data) {
        // console.log('Received newPanier event:', data);
        // Handle the newPanier event data here
            notificationsCount += 1
            notificationsCountElem.attr('data-count', notificationsCount)
            notificationsWrapper.find('.notif-count').text(notificationsCount)
            notificationsWrapper.show()
            let template = `    <a href="#" class="flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="w-32 overflow-hidden">
                                        <img class="object-cover h-20" src="{{asset('assets/images/products/${data.img}')}}" alt="Bonnie image">

                                    </div>
                                    <div class="w-full pl-3">
                                        <div class="text-gray-500 text-md mb-1 dark:text-gray-400"><span class="font-bold text-gray-900 dark:text-white">${data.product_name}</div>
                                            <div class="text-gray-500 text-sm mb-1 dark:text-gray-400"><span class="opacity-80 text-gray-900 dark:text-white">${data.admin}</div>
                                        <div class="text-lg text-bold text-regal-brown dark:text-regal-amber-700">${data.product_price}</div>
                                    </div>
                                </a>
                            `
            let template2= `<hr class="opacity-70 p-0">`
            var lastAElement = ulElement.querySelector("li:last-child a");
            if (lastAElement) {
                var newLiElement = document.createElement("li");
                newLiElement.innerHTML = template;
                // Insert the new <li> element before the parent of the last <a> tag
                lastAElement.parentElement.before(newLiElement);
                // Insert the horizontal line after the new <li> element
                newLiElement.insertAdjacentHTML('afterend', template2);          
            }
    });

// channel.bind('pusher:subscription_succeeded', function(data) {
//     console.log('Subscription to new-panier channel succeeded:', data);
// });

console.log('pusher')