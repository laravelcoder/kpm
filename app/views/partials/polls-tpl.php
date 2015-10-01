<script id="polls-result" type="text/x-handlebars-template">
	<div class="poll-result">
   		{{#each this}}
       		<div class="vote-item">
       			<div class="text-muted">{{title}}</div>
       			<div class="vote-result-value" style="width: {{count}}%;">{{count}}%</div>
       		</div>
       	{{/each}}
   </div>
</script>