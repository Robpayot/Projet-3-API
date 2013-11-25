var player={
	
	params : {
		video:'',
		progressBar:'',
		button:'',
		buffer:'',
		duration:'',
		cTime:'',
		muteButton:'',
		volumeBar:'',
		fullScreenButton:'',
		onloaded:function(){},
	},

	init : function (options) {
		this.params=$.extend(this.params,options);
		$(this.params.video).bind('timeupdate',this.updateProgress);
	},
	
	
	playPause : function () {
		var media=$(player.params.video)[0];
		if(media.paused){
			media.play();
			$(player.params.button).addClass('pause');
			$(player.params.button).removeClass('play');
		}
		else{
			media.pause();
			$(player.params.button).addClass('play');
			$(player.params.button).removeClass('pause');
		}
	},

	updateProgress : function () {
		var media=$(this)[0];

		var progressW=media.currentTime*100/media.duration;
		$(player.params.progressBar).width(progressW+'%');
	
		var bufferW=media.buffered.end(0)*100/media.duration;
		$(player.params.buffer).width(bufferW+'%');
	},

	setTime : function (e) {
		var media=$(player.params.video)[0];
		media.currentTime=e.offsetX*media.duration/$(this).width();
	},

	mute: function () {
		var media=$(player.params.video)[0];
		if (media.muted == false) {
		    // Mute the video
		    media.muted = true;

		    // Update the button text
		    console.log("mute");
		    player.params.muteButton.innerHTML = "Unmute";
		    $(player.params.volumeBar).val(0);
		} else {
		    // Unmute the video
		    media.muted = false;

		    // Update the button text
		    console.log("unmute");
		    player.params.muteButton.innerHTML = "Mute";
		    $(player.params.volumeBar).val(1);
		    console.log($(player.params.volumeBar).val());
		}
	},

	fullScreen : function () {
		var media=$(player.params.video)[0];
		if (media.requestFullscreen) {
		  media.requestFullscreen();
		} else if (media.mozRequestFullScreen) {
		  media.mozRequestFullScreen(); // Firefox
		} else if (media.webkitRequestFullscreen) {
		  media.webkitRequestFullscreen(); // Chrome and Safari
		}
	},

	volume : function() {
		var media=$(player.params.video)[0];
		media.volume = $(player.params.volumeBar).val();
	},

	displayTime : function() {
		var media=$(player.params.video)[0];
		$(player.params.cTime).html(player.formatTime(media.currentTime));
    	$(player.params.duration).html(player.formatTime(media.duration));
	},

	formatTime : function(seconds) {
	  seconds = Math.round(seconds);
	  minutes = Math.floor(seconds / 60);
	  minutes = (minutes >= 10) ? minutes : "0" + minutes;
	  seconds = Math.floor(seconds % 60);
	  seconds = (seconds >= 10) ? seconds : "0" + seconds;
	  return minutes + ":" + seconds;
	},
	
};


player.init({
	video:'#video',
	button:'#button',
	progressBar:'.progress',
	buffer:'.buffer',
	duration:'#duration',
	cTime:'#current',
	muteButton:'#mute',
	volumeBar:'#volume-bar',
	fullScreenButton:'#full-screen',
	onloaded:function(){
		player.playPause();
	},
});

$('#video, #button').on('click',player.playPause);
$('#progressBar').on('click',player.setTime);
$('#mute').on('click',player.mute);
$('#full-screen').on('click',player.fullScreen);
$('#volume-bar').on('change',player.volume);
$("#video").on("timeupdate",player.displayTime);

