<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2018, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('Nenhum acesso direto ao script é permitido');

$lang['db_invalid_connection_str'] = 'Não é possível determinar as configurações do banco de dados com base na sequência de conexão que você enviou.';
$lang['db_unable_to_connect'] = 'Não é possível conectar-se ao seu servidor de banco de dados usando as configurações fornecidas.';
$lang['db_unable_to_select'] = 'Não é possível selecionar o banco de dados especificado: %s';
$lang['db_unable_to_create'] = 'Não é possível criar o banco de dados especificado: %s';
$lang['db_invalid_query'] = 'A consulta enviada não é válida.';
$lang['db_must_set_table'] = 'Você deve configurar a tabela do banco de dados para ser usada com sua consulta.';
$lang['db_must_use_set'] = 'Você deve usar o método "set" para atualizar uma entrada.';
$lang['db_must_use_index'] = 'Você deve especificar um índice para corresponder nas atualizações do lote.';
$lang['db_batch_missing_index'] = 'Uma ou mais linhas enviadas para atualização de lote estão faltando o índice especificado.';
$lang['db_must_use_where'] = 'As atualizações não são permitidas a menos que elas contenham uma condição "where".';
$lang['db_del_must_use_where'] = 'As exclusões não são permitidas a menos que contenham uma condição "where" ou "like".';
$lang['db_field_param_missing'] = 'Para buscar campos requer o nome da tabela como um parâmetro.';
$lang['db_unsupported_function'] = 'Esse recurso não está disponível para o banco de dados que você está usando.';
$lang['db_transaction_failure'] = 'Falha na transação: Reversão Executada.';
$lang['db_unable_to_drop'] = 'Não é possível usar DROP no banco de dados especificado.';
$lang['db_unsupported_feature'] = 'Funcionalidade não suportada da plataforma de banco de dados que você está usando.';
$lang['db_unsupported_compression'] = 'O formato de compactação de arquivos escolhido não é suportado pelo servidor.';
$lang['db_filepath_error'] = 'Não foi possível gravar dados no caminho do arquivo que você enviou.';
$lang['db_invalid_cache_path'] = 'O caminho do cache que você enviou não é válido ou gravável.';
$lang['db_table_name_required'] = 'É necessário um nome de tabela para essa operação.';
$lang['db_column_name_required'] = 'É necessário um nome de coluna para essa operação.';
$lang['db_column_definition_required'] = 'É necessária uma definição de coluna para essa operação.';
$lang['db_unable_to_set_charset'] = 'Não é possível definir o conjunto de caracteres de conexão do cliente: %s';
$lang['db_error_heading'] = 'Ocorreu um erro de banco de dados';
