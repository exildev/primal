<?php


/**
 *  Archivo de configuracion de sistema
 */
interface Config {
    /**
     * Configuracion de la base de datos
     */
    const dbmg = 'mysql';//postgres - oracle - sqlserver
    const dbnm = 'app';
    const host = 'localhost';
    const port = '3306';
    const user = 'root';
    const pass = '';
    
    /**
     *  Configuracion de idioma
     */
    const lang = 'es';
    
    /**
     *  Configuracion del proyecto
     */
    const template = '/template';
    const debug = true;
    
}
