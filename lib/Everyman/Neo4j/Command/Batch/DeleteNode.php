<?php
namespace Everyman\Neo4j\Command\Batch;
use Everyman\Neo4j\Client,
	Everyman\Neo4j\Node,
	Everyman\Neo4j\Command\DeleteNode as SingleDeleteNode;

/**
 * Delete a node in a batch
 */
class DeleteNode extends Command
{
	protected $opId = null;
	protected $base = null;

	/**
	 * Set the operation to drive the command
	 *
	 * @param Client $client
	 * @param Node $node
	 * @param integer $opId
	 */
	public function __construct(Client $client, Node $node, $opId)
	{
		parent::__construct($client);
		$this->base = new SingleDeleteNode($client, $node);
		$this->opId = $opId;
	}

	/**
	 * Return the data to pass
	 *
	 * @return array
	 */
	protected function getData()
	{
		$opData = array(array(
			'method' => strtoupper($this->base->getMethod()),
			'to' => $this->base->getPath(),
			'id' => $this->opId,
		));
		return $opData;
	}

	/**
	 * Use the results
	 *
	 * @param array $result
	 */
	protected function handleSingleResult($result){}
}

