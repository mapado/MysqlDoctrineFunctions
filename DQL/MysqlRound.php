<?php
namespace Mapado\MysqlDoctrineFunctions\DQL;

use Doctrine\ORM\Query\AST\ArithmeticExpression;
use \Doctrine\ORM\Query\AST\Functions\FunctionNode;
use \Doctrine\ORM\Query\Lexer;
use \Doctrine\ORM\Query\QueryException;

/**
 * MysqlRound
 *
 * @uses FunctionNode
 * @author Julien DENIAU <jdeniau.externe@mapado.com>
 */
class MysqlRound extends FunctionNode
{
    /**
     * simpleArithmeticExpression
     *
     * @var mixed
     * @access public
     */
    public $simpleArithmeticExpression;

    /**
     * roundPrecision
     *
     * @var mixed
     * @access public
     */
    public $roundPrecision;

    /**
     * getSql
     *
     * @param \Doctrine\ORM\Query\SqlWalker $sqlWalker
     * @access public
     * @return string
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return sprintf(
            'ROUND(%s, %s)',
            $sqlWalker->walkSimpleArithmeticExpression($this->simpleArithmeticExpression),
            (is_null($this->roundPrecision) ? 0 : $sqlWalker->walkStringPrimary($this->roundPrecision))
        );
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

        $this->simpleArithmeticExpression = $parser->SimpleArithmeticExpression();

        try {
            $parser->match(Lexer::T_COMMA);
            $this->roundPrecision = $parser->ArithmeticExpression();
        } catch(QueryException $e) {
            // ROUND() is being used without round precision
        }

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
