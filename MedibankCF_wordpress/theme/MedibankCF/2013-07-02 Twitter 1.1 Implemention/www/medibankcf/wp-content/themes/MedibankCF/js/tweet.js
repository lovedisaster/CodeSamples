
// 
//
//		CUSTOM TWITTER FEED
// 		created for MCF - 7 September 2011
//
//////////////////////////////////////////////////////////////


$(document).ready(function() {
    /*
    // Declare variables to hold twitter API url and user name
    var twitter_api_url = 'https://api.twitter.com/1/statuses/user_timeline.json';
    var twitter_user = 'MedibankCF';
    var password = 'feb1pinwheel';
    //var tag = '%23DidYouKnow';
    var tweet_count = '6';
    var holder = '#medibankFeed';

    // Enable caching
    $.ajaxSetup({ cache: true });
    //Parse tweet for URLs
    String.prototype.parseURL = function() {
        return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&~\?\/.=]+/g, function(url) {
            return url.link(url);
        });
    };

    //Parse tweet for @Usernames
    String.prototype.parseUsername = function() {
        return this.replace(/[@]+[A-Za-z0-9-_]+/g, function(u) {
            var username = u.replace("@", "")
            return u.link("http://twitter.com/" + username);
        });
    };

    //Parse tweet for #Hashtags
    String.prototype.parseHashtag = function() {
        return this.replace(/[#]+[A-Za-z0-9-_]+/g, function(t) {
            var tag = t.replace("#", "%23")
            return t.link("http://twitter.com/search?q=" + tag + '&src=typd');
        });
    };

    /*Send JSON request and parse tweet as required and append to holder
    $.getJSON(twitter_api_url + '?callback=?&rpp=' + tweet_count + '&q=from:' + twitter_user + tag,
    function(data) {
    $.each(data.results, function(i, tweet) {
    var tweet = tweet.text;
    var tweet_text = '<div class="headline scrollable"><p class="tweet">' + tweet.parseURL().parseUsername().parseHashtag() + '</p></div>';
    $(".tweet a").attr("target", "_blank");
    $(holder).append(tweet_text);
    })
    .success(function() { alert("success 2"); })
    .error(function() { alert("error occurred "); })
    .complete(function() { alert("Done"); });
    });

    $.ajax({
        //url: 'https://api.twitter.com/1/statuses/user_timeline.json?screen_name=MedibankCF&hashtags=%23DidYouKnow&include_rts=true&callback=?&count=5',
        //url: twitter_api_url + '?screen_name=' + twitter_user + '&hashtags='+tag+'&include_rts=true&callback=?&count=' + tweet_count,
        url: twitter_api_url + '?screen_name=' + twitter_user + '&include_rts=true&callback=?&count=' + tweet_count,
        dataType: 'jsonp',
        success: function(data) {
            $.each(data, function(i, tweet) {
                var tweet = tweet.text;
                var tweet_text = '<div class="headline scrollable"><p class="tweet">' + tweet.parseURL().parseUsername().parseHashtag() + '</p></div>';
                $(".tweet a").attr("target", "_blank");
                $(holder).append(tweet_text);
            })
        },
        error: function(request, status, error) {
            alert(request.responseText);
        }
    });*/
    


var slider = jQuery('div#medibankFeed'); // class or id of carousel slider
var slide = 'p'; // could also use 'img' if you're not using a ul
var transition_time = 1000; // 1 second
var time_between_slides = 4000; // 4 seconds

function slides() {
    return slider.find(slide);
}
slides().fadeOut();

//set active classes
slides().first().addClass('active');
slides().first().fadeIn(transition_time);

//auto scroll
setInterval(function() {
    var i = slider.find(slide + '.active').index();
    slides().eq(i).removeClass('active');
    slides().eq(i).fadeOut(transition_time);

    if (slides().length == i + 1) i = -1; // loop to start

    slides().eq(i + 1).fadeIn(transition_time);
    slides().eq(i + 1).addClass('active');
}, transition_time + time_between_slides);

});

	