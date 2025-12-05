@echo off
chcp 65001 >nul
echo ========================================
echo   Restaurar Backup do Banco OFICINA
echo ========================================
echo.

if not exist "backup" (
    echo Pasta backup nao encontrada!
    pause
    exit
)

echo Arquivos de backup disponiveis:
echo.
dir /b backup\*.sql
echo.

set /p arquivo="Digite o nome do arquivo de backup: "

if not exist "backup\%arquivo%" (
    echo Arquivo nao encontrado!
    pause
    exit
)

echo.
echo Restaurando backup: %arquivo%
echo.

REM Restaurar backup
mysql -u root -pCharlo2025@ < "backup\%arquivo%" 2>nul

if %errorlevel% == 0 (
    echo ✓ Backup restaurado com sucesso!
) else (
    echo ✗ ERRO ao restaurar backup!
    echo Verifique usuario e senha
)

echo.
pause

