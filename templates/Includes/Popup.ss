<% if Popup %>

  <div class="popup" data-displaydelay="$PopupConfig.DisplayDelay" data-timestamp="$PopupTimeStamp">
    <div>
  		<div class="close">X</div>
  		<div class="row">
        <% if PopupConfig.Image %>
  			  <div class="col-xs-12 col-sm-6">
  			  	$PopupConfig.Image
  		  	</div>
  			  <div class="col-xs-12 col-sm-6">
  		      <div class="content typography">
  			  		$PopupConfig.Content
            <a class="redirect" data-href="$PopupConfig.Redirect.AbsoluteLink"><button>$PopupConfig.ButtonText</button></a>
  			  	</div>
  		  	</div>
        <% else %>
          <div class="col-xs-12">
  		      <div class="content typography">
  			  		$PopupConfig.Content
            <a class="redirect" data-href="$PopupConfig.Redirect.AbsoluteLink"><button>$PopupConfig.ButtonText</button></a>
  			  	</div>
  		  	</div>
        <% end_if %>
  		</div>
  	</div>
  </div>

  <% require css("intwebg/silverstripe-popup:client/css/popup.css") %>
  <% require javascript("intwebg/silverstripe-popup:client/javascript/popup.js") %>

<% end_if %>
