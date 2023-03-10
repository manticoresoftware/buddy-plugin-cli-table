<?php declare(strict_types=1);

/*
  Copyright (c) 2023, Manticore Software LTD (https://manticoresearch.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License version 2 or any later
  version. You should have received a copy of the GPL license along with this
  program; if you did not, you can find it at http://www.gnu.org/
*/

namespace Manticoresearch\Buddy\Plugin\CliTable;

use Manticoresearch\Buddy\Core\ManticoreSearch\Endpoint as ManticoreEndpoint;
use Manticoresearch\Buddy\Core\Network\Request as NetworkRequest;
use Manticoresearch\Buddy\Core\Plugin\Request as BaseRequest;

/**
 * Request for CliTable command
 */
final class Request extends BaseRequest {
	public string $query;
	public string $path;

	/**
	 * @param NetworkRequest $request
	 * @return static
	 */
	public static function fromNetworkRequest(NetworkRequest $request): static {
		$self = new static();
		$self->query = $request->payload;
		$self->path = ManticoreEndpoint::Sql->value;
		return $self;
	}

	/**
	 * @param NetworkRequest $request
	 * @return bool
	 */
	public static function hasMatch(NetworkRequest $request): bool {
		return $request->endpointBundle === ManticoreEndpoint::Cli;
	}
}
