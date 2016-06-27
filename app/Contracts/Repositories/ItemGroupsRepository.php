<?php

namespace App\Contracts\Repositories;

interface ItemGroupsRepository extends BaseRepository
{
    function parent($id);

    function children($id);

    function ancestors($id);
}