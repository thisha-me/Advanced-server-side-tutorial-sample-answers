<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catmodel extends CI_Model {

	/** Pick one random cat from the database. */
	public function getRandom() {
		$this->db->order_by('RAND()');
		$query = $this->db->get('cats', 1);
		return $query->num_rows() > 0 ? $query->row() : NULL;
	}

	/** Fetch all cats whose id is in $ids. Used by getcats() for the "last 3 liked" sidebar. */
	public function getByIds($ids) {
		if (empty($ids)) return array();
		$this->db->where_in('id', $ids);
		$query = $this->db->get('cats');
		return $query->result();
	}

	/** Get cat objects for given ids, in the same order as $ids (for viewed_cats sidebar). */
	public function getcats($ids) {
		if (empty($ids)) return array();
		$ids = array_map('intval', $ids);
		$cats = $this->getByIds($ids);
		$by_id = array();
		foreach ($cats as $c) $by_id[$c->id] = $c;
		$ordered = array();
		foreach ($ids as $id) {
			if (isset($by_id[$id])) $ordered[] = $by_id[$id];
		}
		return $ordered;
	}

	/** Increment like_count for the given cat. */
	public function addLike($id) {
		$this->db->set('like_count', 'like_count + 1', FALSE);
		$this->db->where('id', (int)$id);
		$this->db->update('cats');
	}

	/** Increment dislike_count for the given cat. */
	public function addDislike($id) {
		$this->db->set('dislike_count', 'dislike_count + 1', FALSE);
		$this->db->where('id', (int)$id);
		$this->db->update('cats');
	}

}
