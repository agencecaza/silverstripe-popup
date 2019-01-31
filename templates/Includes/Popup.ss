<% if PopUp %>

  <div class="popup" data-timestamp="$PopUpTimeStamp">
    <div>
  		<div class="close close">X</div>
  		<div class="row">
  			<div class="col-xs-12 col-sm-6">
  				$PopupConfig.Image
  			</div>
  			<div class="col-xs-12 col-sm-6">
  		    <div class="content typography">
  					$PopupConfig.Content
  					<a href="$PopupConfig.Redirection.Link"><input type="submit" value="$PopupConfig.ButtonText"/></a>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>

  <% require css("intwebg/silverstripe-popup:client/css/popup.css") %>
  <% require javascript("intwebg/silverstripe-popup:client/javascript/popup.js") %>

<% end_if %>
