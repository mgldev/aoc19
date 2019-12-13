<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 11/12/19
 * Time: 19:25
 */

namespace AOC\D3\P1;


interface GridRendererInterface
{
    public function render(Grid $grid, array $options = []): string;
}