<?php

function allowed($module, $action) {
	return Access::check($module, $action);
}
