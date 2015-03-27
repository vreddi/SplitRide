var adBanner = (function(){
    function chUrl(campaign) {
        return "https://codinghire.com/m/collabedit-story?utm_medium=banner&utm_source=collabedit.com"
            +"&utm_campaign=" + campaign;
    }

    function chImg(campaign) {
        return "/static/img/codinghire-ads/" + campaign + ".png"
    }

    var chCampaigns = [
        // "mdskill", "timemoney", "korganized", "hiredevs", "join100"
        // "provenscreen", "candidatesprefer", "mdskill30", "hiretechtal", "whatdo100"
        // "intdevs", "donttillimage", "discwayintdevs", "waitch", "why100"
        // "donttillimage", "waitch", "mdskill30", "whatdo100", "candidatesprefer"
        "cancodercode", "tiredwasting", "betterbyimprove", "execcode", "threereasons"
    ];

    var ads = [];
    for(var i=0;i<chCampaigns.length;i++) {
        ads.push({imgUrl: chImg(chCampaigns[i]), url: chUrl(chCampaigns[i])})
    }

    function displayAd() {
        var idx = Math.floor(Math.random() * ads.length);
        var adToShow = ads[idx];

        $("#ch-block-img").attr("src", adToShow.imgUrl);
        $("#ch-block-link").attr("href", adToShow.url);
        $("#ch-block").css("display", "block");

        $("#ch-block-link").click(function() {
            $("#ch-block-link").attr("href", "/bouncer?url=" + encodeURIComponent(adToShow.url));
        });
    }

    $(document).ready(displayAd);
})();