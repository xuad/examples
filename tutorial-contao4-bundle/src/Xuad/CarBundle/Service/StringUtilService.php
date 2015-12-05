<?php
/**
 * @author      Patrick Mosch <patrick.mosch@xuad.net>
 * @copyright   Copyright(c) 2015 (http://xuad.net)
 */

namespace Xuad\CarBundle\Service;

class StringUtilService
{
	public function generateAlias($strString)
	{
		return \StringUtil::generateAlias($strString);
	}
}