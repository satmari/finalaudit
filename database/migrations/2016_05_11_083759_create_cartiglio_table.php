<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartiglioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cartiglio', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('Cod_Bar')->nullable();		
			$table->string('Cod_Art_CZ')->nullable();
			$table->string('Cod_Col_CZ')->nullable();
			$table->string('Tgl_ITA')->nullable();
			$table->string('Tgl_ENG')->nullable();
			$table->string('Tgl_SPA')->nullable();
			$table->string('Tgl_EUR')->nullable();
			$table->string('Tgl_USA')->nullable();
			$table->string('Descr_Col_CZ')->nullable();
			$table->string('tagliaCod')->nullable();

			// $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cartiglio');
	}

}

/*
2021.01.06
--- tagliaCod is new

SELECT
	 DISTINCT [barcode]
	,[codArticolo]
	,[coloreCod]
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = [Layout].[size1] and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCOd) as ITA
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = [Layout].[size5] and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCOd) as ENG
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = [Layout].[size3] and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCOd) as SPA
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = [Layout].[size2] and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCOd) as EUR
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = (CASE WHEN [Layout].[size6] = 'USA' THEN 'US' END) and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCod) as USA
	,[coloreDescrizione]
	,[tagliaCod]
	
FROM [172.27.161.249].[Sparrow].[dbo].[Articoli]
INNER JOIN [172.27.161.249].[Sparrow].[dbo].[Layout] ON [Layout].[marchioCod] = [Articoli].[marchioCod]
WHERE [Layout].codLayout = layoutCod and barcode <> '' --and codArticolo = 'MOBP0178'

-- update cartiglio
INSERT INTO [finalaudit].[dbo].[cartiglio] (
	 [Cod_Bar]
	,[Cod_Art_CZ]
	,[Cod_Col_CZ]
	,[Tgl_ITA]
	,[Tgl_ENG]
	,[Tgl_SPA]
	,[Tgl_EUR]
	,[Tgl_USA]
	,[Descr_Col_CZ]
	,[tagliaCod]
)

SELECT
	 DISTINCT [barcode]
	,[codArticolo]
	,[coloreCod]
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = [Layout].[size1] and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCOd) as ITA
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = [Layout].[size5] and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCOd) as ENG
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = [Layout].[size3] and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCOd) as SPA
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = [Layout].[size2] and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCOd) as EUR
	,(select valore from [172.27.161.249].[Sparrow].[dbo].[Taglie] where [Taglie].lingua = (CASE WHEN [Layout].[size6] = 'USA' THEN 'US' END) and [Taglie].codCastelletto = castellettoCod and [Taglie].codTaglia = tagliaCod) as USA
	,[coloreDescrizione]
	,[tagliaCod]
	
FROM [172.27.161.249].[Sparrow].[dbo].[Articoli]
INNER JOIN [172.27.161.249].[Sparrow].[dbo].[Layout] ON [Layout].[marchioCod] = [Articoli].[marchioCod]
WHERE [Layout].codLayout = layoutCod and barcode <> '' --and codArticolo = 'MOBP0178'


*/



/*
USE [finalaudit]
GO


SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[cartiglio](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[Cod_Bar] [nvarchar](255) NOT NULL,
	[Cod_Art_CZ] [nvarchar](255) NOT NULL,
	[Cod_Col_CZ] [nvarchar](255) NOT NULL,
	[Tgl_EUR] [nvarchar](255) NOT NULL,
	[Descr_Col_CZ] [nvarchar](255) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

*/
/*
USE [finalaudit]
GO


SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[cartiglio](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[Cod_Bar] [nvarchar](255) NOT NULL,
	[Cod_Art_CZ] [nvarchar](255) NOT NULL,
	[Cod_Col_CZ] [nvarchar](255) NOT NULL,
	[Tgl_ITA] [nvarchar](255) NOT NULL,
	[Tgl_ENG] [nvarchar](255) NOT NULL,
	[Tgl_SPA] [nvarchar](255) NOT NULL,
	[Tgl_EUR] [nvarchar](255) NOT NULL,
	[Tgl_USA] [nvarchar](255) NOT NULL,
	[Descr_Col_CZ] [nvarchar](255) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
*/