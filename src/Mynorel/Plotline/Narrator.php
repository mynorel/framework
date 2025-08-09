<?php
namespace Mynorel\Plotline;

/**
 * Narrator: Query builder for Plotline ORM (guides the unfolding of data).
 */




use Mynorel\Plotline\Database\QueryBuilder;

/**
 * Narrator: Query builder for Plotline ORM (guides the unfolding of data).
 * In Mynorel, the Narrator tells the story by building and executing queries.
 */
class Narrator
{
	protected string $plotClass;
	protected array $where = [];
	protected array $with = [];
	protected array $order = [];
	protected array $joins = [];
	protected array $aggregates = [];
	protected array $errors = [];

	public function __construct(string $plotClass)
	{
		$this->plotClass = $plotClass;
	}

	public function where(string $field, string $op, $value): self
	{
		$this->where[] = [$field, $op, $value];
		return $this;
	}

	public function with(string $relation): self
	{
		$this->with[] = $relation;
		return $this;
	}

	public function orderBy(string $field, string $direction = 'asc'): self
	{
		$this->order[] = [$field, $direction];
		return $this;
	}

	public function join(string $related, string $localKey, string $foreignKey): self
	{
		$this->joins[] = compact('related', 'localKey', 'foreignKey');
		return $this;
	}

	public function aggregate(string $type, string $field): self
	{
		$allowed = ['count', 'sum', 'avg', 'min', 'max'];
		if (!in_array($type, $allowed)) {
			$this->errors[] = "Invalid aggregate: $type";
			if (class_exists('Mynorel\\Facades\\Chronicle')) {
				\Mynorel\Facades\Chronicle::warn("Invalid aggregate: $type");
			}
			return $this;
		}
		$this->aggregates[] = compact('type', 'field');
		return $this;
	}

	/**
	 * Tell the story: execute the query and return results.
	 */
	public function tell(): array
	{
		if (!empty($this->errors)) {
			if (class_exists('Mynorel\\Facades\\Chronicle')) {
				foreach ($this->errors as $err) {
					\Mynorel\Facades\Chronicle::warn($err);
				}
			}
			return ['error' => $this->errors];
		}
		$table = call_user_func([$this->plotClass, 'table']);
		$qb = new QueryBuilder();
		$qb->table($table);
		foreach ($this->where as [$field, $op, $value]) {
			$qb->where($field, $op, $value);
		}
		if ($this->order) {
			[$field, $direction] = $this->order[0];
			$qb->orderBy($field, $direction);
		}
		// Aggregates and joins can be expanded here
		return $qb->get();
	}
}
