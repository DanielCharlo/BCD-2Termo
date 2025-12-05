@echo off
chcp 65001 >nul
echo ========================================
echo    Backup do Banco de Dados OFICINA
echo ========================================
echo.

REM Criar pasta backup se não existir
if not exist "backup" mkdir backup

REM Data e hora para nome do arquivo
for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value') do set datetime=%%I
set data=%datetime:~0,8%
set hora=%datetime:~8,6%
set arquivo=backup\oficina_backup_%data%_%hora%.sql

echo Criando backup do banco OFICINA...
echo.

REM Fazer backup (ajuste usuario e senha se necessario)
mysqldump -u root -pCharlo2025@ --databases OFICINA > "%arquivo%" 2>nul

if exist "%arquivo%" (
    echo ✓ Backup criado com sucesso!
    echo.
    echo Arquivo: %arquivo%
    echo Tamanho: 
    for %%A in ("%arquivo%") do echo   %%~zA bytes
) else (
    echo ✗ ERRO ao criar backup!
    echo.
    echo Verifique:
    echo - MySQL esta instalado e no PATH
    echo - Usuario e senha corretos
    echo - Banco OFICINA existe
    echo.
    echo Tente executar manualmente:
    echo mysqldump -u root -p OFICINA ^> backup.sql
)

echo.
pause
