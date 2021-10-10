function ratingSystem(type, location, postId, userId) {
    console.log({ location })
    // return;
    $.ajax({
        type: 'POST',
        url: 'rating-system/rating-config.php',
        cache: false,
        data: {
            type: type,
            postId: postId,
            userId: userId
        },
        success: function (data) {


            setTimeout(function () {
                let result = JSON.parse(data);
                let { upvote, downvote } = result;

                let upvote_text = document.getElementById('upvoteElement_' + postId)
                let downvote_text = document.getElementById('downvoteElement_' + postId)

                upvote_text.innerHTML = "Upvotes: " + upvote;
                downvote_text.innerHTML = "Downvotes: " + downvote;


            }, 1000);


        }
    });
}

