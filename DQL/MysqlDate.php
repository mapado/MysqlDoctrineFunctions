<?php
namespace Mapado\MysqlDoctrineFunctions\DQL;

use \Doctrine\ORM\Query\AST\Functions\FunctionNode;
use \Doctrine\ORM\Query\Lexer;

/**
 * MysqlRand
 * 
 * @uses FunctionNode
 * @author Simone Fumagalli - www.iliveinperego.com
 */
class MysqlDate extends FunctionNode
{

    /*
    * Holds the date of the DATE statement
    * @var mixed
    */
    protected $dateExpression;
    
    /**
     * getSql
     *
     * @param \Doctrine\ORM\Query\SqlWalker $sqlWalker
     * @access public
     * @return string
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'DATE(' . $this->dateExpression->dispatch($sqlWalker) . ')';
    }

    /**
     * parse
     *
     * @param \Doctrine\ORM\Query\Parser $parser
     * @access public
     * @return void
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->dateExpression = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
