
	<style type="text/css">

	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		padding: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>

<div id="container">
	<h1>Page with 500kb</h1>

	<div id="body">
		<img src="<?= $this->config->item('domain') ?>/public/images/100kb.png" />
        <img src="<?= $this->config->item('domain') ?>/public/images/100kb-2.png" />
        <img src="<?= $this->config->item('domain') ?>/public/images/100kb-3.png" />
        <img src="<?= $this->config->item('domain') ?>/public/images/100kb-4.png" />
        <img src="<?= $this->config->item('domain') ?>/public/images/100kb-5.png" />
    </div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>