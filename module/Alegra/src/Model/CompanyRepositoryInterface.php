<?php 

namespace Alegra\Model;

interface CompanyRepositoryInterface
{
    /**
     * Return a single company.
     *
     * @return Company
     */
    public function findCompany();
}