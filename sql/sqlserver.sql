USE [master]
GO
/****** Object:  Database [data]    Script Date: 2019/3/12 0:12:22 ******/
CREATE DATABASE [data]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'data', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.SQL2014\MSSQL\DATA\data.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'data_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.SQL2014\MSSQL\DATA\data_log.ldf' , SIZE = 2048KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [data] SET COMPATIBILITY_LEVEL = 100
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [data].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [data] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [data] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [data] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [data] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [data] SET ARITHABORT OFF 
GO
ALTER DATABASE [data] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [data] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [data] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [data] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [data] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [data] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [data] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [data] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [data] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [data] SET  DISABLE_BROKER 
GO
ALTER DATABASE [data] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [data] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [data] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [data] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [data] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [data] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [data] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [data] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [data] SET  MULTI_USER 
GO
ALTER DATABASE [data] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [data] SET DB_CHAINING OFF 
GO
ALTER DATABASE [data] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [data] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [data] SET DELAYED_DURABILITY = DISABLED 
GO
EXEC sys.sp_db_vardecimal_storage_format N'data', N'ON'
GO
USE [data]
GO
/****** Object:  Table [dbo].[单位信息表]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[单位信息表](
	[单位名称] [nvarchar](50) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[会员卡金额变动明细表]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[会员卡金额变动明细表](
	[序号] [int] IDENTITY(1,1) NOT NULL,
	[日期] [datetime] NULL,
	[会员编号] [nvarchar](40) NULL,
	[发生金额] [money] NULL,
	[变动类型] [nvarchar](8) NULL,
	[销售编号] [nvarchar](50) NULL,
	[充值方式] [nvarchar](20) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[会员库]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[会员库](
	[序号] [nvarchar](40) NULL,
	[条形码] [nvarchar](30) NULL,
	[姓名] [nvarchar](14) NULL,
	[手机号码] [nvarchar](20) NULL,
	[微信号] [nvarchar](20) NULL,
	[拼音助记码] [nvarchar](10) NULL,
	[出生年月] [datetime] NULL,
	[出生年] [int] NULL,
	[出生月] [int] NULL,
	[出生日] [int] NULL,
	[卡余额] [money] NULL,
	[消费金额] [money] NULL,
	[消费密码] [nvarchar](50) NULL,
	[消费积分] [money] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[进货明细表]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[进货明细表](
	[序号] [int] IDENTITY(1,1) NOT NULL,
	[日期] [datetime] NULL,
	[商品序号] [nvarchar](40) NOT NULL,
	[进货单价] [money] NULL,
	[数量] [int] NULL,
	[金额] [money] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[商品表]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[商品表](
	[商品序号] [nvarchar](40) NOT NULL,
	[商品种类] [nvarchar](20) NOT NULL,
	[厂家] [nvarchar](40) NULL,
	[型号] [nvarchar](20) NULL,
	[颜色] [nvarchar](20) NULL,
	[尺码] [nvarchar](20) NULL,
	[材质] [nvarchar](30) NULL,
	[进货均价] [float] NULL,
	[销售价] [float] NULL,
	[会员打折] [float] NULL CONSTRAINT [DF_商品表_会员打折]  DEFAULT ((0)),
	[会员销售价] [float] NULL,
	[充值卡打折] [float] NULL CONSTRAINT [DF_商品表_充值卡打折]  DEFAULT ((0)),
	[充值卡售价] [float] NULL,
	[库存数量] [int] NULL CONSTRAINT [DF_商品表_库存数量]  DEFAULT ((0)),
	[条码] [nvarchar](20) NULL,
	[是否停用] [nvarchar](6) NULL,
 CONSTRAINT [PK_商品表] PRIMARY KEY CLUSTERED 
(
	[商品序号] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[商品种类库]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[商品种类库](
	[序号] [int] IDENTITY(1,1) NOT NULL,
	[商品种类] [nvarchar](20) NOT NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[上缴明细表]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[上缴明细表](
	[序号] [int] IDENTITY(1,1) NOT NULL,
	[日期] [datetime] NULL,
	[销售编号] [nvarchar](40) NULL,
	[上缴现金] [money] NULL,
	[上缴pos单] [money] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[系统设置]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[系统设置](
	[会员打折] [money] NULL,
	[充值卡打折] [money] NULL,
	[最低充值] [int] NULL,
	[会员积分活动] [int] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[销售记录]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[销售记录](
	[序号] [int] NULL,
	[日期] [datetime] NULL,
	[会员编号] [nvarchar](40) NULL,
	[会员姓名] [nvarchar](14) NULL,
	[销售编号] [nvarchar](40) NULL,
	[销售姓名] [nvarchar](14) NULL,
	[销售价] [money] NULL,
	[数量] [int] NULL,
	[应收] [money] NULL,
	[优惠] [money] NULL,
	[实收] [money] NULL,
	[收款方式] [nvarchar](20) NULL,
	[收款金额] [money] NULL,
	[找零金额] [money] NULL,
	[可用积分] [money] NULL,
	[会员卡余额] [money] NULL,
	[出货方式] [nvarchar](20) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[销售明细表]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[销售明细表](
	[序号] [int] IDENTITY(1,1) NOT NULL,
	[日期] [datetime] NULL,
	[销售序号] [int] NULL,
	[商品序号] [nvarchar](40) NULL,
	[会员编号] [nvarchar](40) NULL,
	[会员姓名] [nvarchar](14) NULL,
	[销售编号] [nvarchar](40) NULL,
	[销售姓名] [nvarchar](14) NULL,
	[销售价] [money] NULL,
	[折扣] [money] NULL,
	[折后价] [money] NULL,
	[是否退货] [nvarchar](10) NULL,
	[销售方式] [nvarchar](20) NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[用户管理]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[用户管理](
	[用户编号] [nvarchar](40) NULL,
	[登录名称] [nvarchar](20) NOT NULL,
	[真实姓名] [nvarchar](20) NULL,
	[权限] [nvarchar](10) NOT NULL,
	[密码] [nvarchar](15) NOT NULL,
	[联系电话] [nvarchar](30) NULL,
	[现金收款] [float] NULL,
	[pos收款] [float] NULL,
	[销售数量] [int] NULL
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[支出明细表]    Script Date: 2019/3/12 0:12:23 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[支出明细表](
	[序号] [int] IDENTITY(1,1) NOT NULL,
	[支出明细] [nvarchar](150) NULL,
	[支出金额] [money] NULL,
	[支出日期] [datetime] NULL,
	[登记日期] [datetime] NULL,
	[备注] [nvarchar](100) NULL
) ON [PRIMARY]

GO
INSERT [dbo].[单位信息表] ([单位名称]) VALUES (N'商品进销存管理系统')
SET IDENTITY_INSERT [dbo].[会员卡金额变动明细表] ON 

INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1, CAST(N'2017-07-08 00:00:00.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 1000.0000, N'充值', N'4be539ae-0300-4aff-83b9-afeb7dade7a0', N'pos刷卡充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (2, CAST(N'2019-03-03 00:00:00.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', -319.2000, N'消费', N'4be539ae-0300-4aff-83b9-afeb7dade7a0', NULL)
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1002, CAST(N'2019-03-08 12:00:00.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 100.0000, N'充值', N'123456', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1003, CAST(N'2019-03-08 07:34:08.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 100.0000, N'充值', N'469E2AF0-83FE-546B-8A44-3148572F761C', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1004, CAST(N'2019-03-08 07:36:29.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 100.0000, N'充值', N'21AB46AA-0269-314F-3AC1-5A701ABED351', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1011, CAST(N'2019-03-08 12:00:00.000' AS DateTime), N'98C3274F-C81C-542D-3312-93D498655ECC', 520.0000, N'充值', N'101010', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1012, CAST(N'2019-03-09 03:31:35.000' AS DateTime), N'', 100.0000, N'充值', N'C9A7BFBD-9992-E513-8A52-A042FFE64C9F', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1013, CAST(N'2019-03-09 03:31:51.000' AS DateTime), N'', 100.0000, N'充值', N'88DD86A3-B152-5B4F-3E3B-F73D24C0B324', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1014, CAST(N'2019-03-09 08:14:14.000' AS DateTime), N'16F8CFFC-A08F-5438-871E-2C0887092EA9', 100.0000, N'充值', N'7A87B6FF-DE1D-50C2-0A81-4325A8DFD1D5', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1015, CAST(N'2019-03-10 11:06:23.000' AS DateTime), N'16F8CFFC-A08F-5438-871E-2C0887092EA9', 0.0000, N'充值', N'93A705DA-9074-C728-B701-A057ADDCC51F', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1016, CAST(N'2019-03-10 11:06:30.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 0.0000, N'充值', N'DEC485B7-7F7C-A167-0D10-0284EC98AEF1', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1017, CAST(N'2019-03-10 11:06:38.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 0.0000, N'充值', N'D12F92B0-16E8-212F-C35E-CFEDE50081A0', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1018, CAST(N'2019-03-10 11:07:33.000' AS DateTime), N'16F8CFFC-A08F-5438-871E-2C0887092EA9', 100.0000, N'充值', N'DD9791F7-5125-7719-88F6-36931262C1D1', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1019, CAST(N'2019-03-10 11:09:44.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 100.0000, N'充值', N'4F87800B-CBC7-FC5A-9C96-FF990426CBDF', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1005, CAST(N'2019-03-08 07:38:09.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 100.0000, N'充值', N'0FD04E84-A6FF-C167-F45C-F5C76A978034', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1006, CAST(N'2019-03-08 07:39:35.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 100.0000, N'充值', N'671B659E-534E-6BCB-474E-6EE5759D8CA6', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1007, CAST(N'2019-03-08 07:45:08.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', 100.0000, N'充值', N'9341F217-DC82-C430-8C81-24B7DF1D22F4', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1008, CAST(N'2019-03-08 07:45:36.000' AS DateTime), N'16F8CFFC-A08F-5438-871E-2C0887092EA9', 100.0000, N'充值', N'E6A78B60-6998-F3A8-853F-6CFDB4BA9D47', N'现金充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1009, CAST(N'2019-03-08 07:46:28.000' AS DateTime), N'16F8CFFC-A08F-5438-871E-2C0887092EA9', 100.0000, N'充值', N'89AD215B-D8BF-7855-451E-581F6FCC89B9', N'支付宝充值')
INSERT [dbo].[会员卡金额变动明细表] ([序号], [日期], [会员编号], [发生金额], [变动类型], [销售编号], [充值方式]) VALUES (1010, CAST(N'2019-03-08 07:47:18.000' AS DateTime), N'16F8CFFC-A08F-5438-871E-2C0887092EA9', 100.0000, N'充值', N'F1963E98-6754-077F-407F-EBF5599707C2', N'微信充值')
SET IDENTITY_INSERT [dbo].[会员卡金额变动明细表] OFF
INSERT [dbo].[会员库] ([序号], [条形码], [姓名], [手机号码], [微信号], [拼音助记码], [出生年月], [出生年], [出生月], [出生日], [卡余额], [消费金额], [消费密码], [消费积分]) VALUES (N'16F8CFFC-A08F-5438-871E-2C0887092EA9', N'', N'乱丶心', N'17851567955', N'17851567955', N'lx', CAST(N'1997-12-18 00:00:00.000' AS DateTime), 1997, 12, 18, 500.0000, 0.0000, N'e10adc3949ba59abbe56e057f20f883e', 0.0000)
INSERT [dbo].[会员库] ([序号], [条形码], [姓名], [手机号码], [微信号], [拼音助记码], [出生年月], [出生年], [出生月], [出生日], [卡余额], [消费金额], [消费密码], [消费积分]) VALUES (N'98C3274F-C81C-542D-3312-93D498655ECC', N'', N'王敏', N'17826615116', N'17826615116', N'wm', CAST(N'1997-04-21 00:00:00.000' AS DateTime), 1997, 4, 21, 520.0000, 520.0000, N'958142e7545cb1226dd882023f364fbe', 520.0000)
INSERT [dbo].[会员库] ([序号], [条形码], [姓名], [手机号码], [微信号], [拼音助记码], [出生年月], [出生年], [出生月], [出生日], [卡余额], [消费金额], [消费密码], [消费积分]) VALUES (N'92F9873C-7A7B-9226-4E9F-D7EC3EE5339B', N'', N'杨勇刚', N'17851567951', N'17851567951', N'yyg', CAST(N'1997-01-01 00:00:00.000' AS DateTime), 1997, 1, 1, 0.0000, 0.0000, N'e10adc3949ba59abbe56e057f20f883e', 0.0000)
INSERT [dbo].[会员库] ([序号], [条形码], [姓名], [手机号码], [微信号], [拼音助记码], [出生年月], [出生年], [出生月], [出生日], [卡余额], [消费金额], [消费密码], [消费积分]) VALUES (N'D25197C9-1984-35A2-972B-903CC22D25DF', N'', N'杨勇刚', N'17851567951', N'17851567951', N'yyg', CAST(N'1997-01-01 00:00:00.000' AS DateTime), 1997, 1, 1, 0.0000, 0.0000, N'e10adc3949ba59abbe56e057f20f883e', 0.0000)
INSERT [dbo].[会员库] ([序号], [条形码], [姓名], [手机号码], [微信号], [拼音助记码], [出生年月], [出生年], [出生月], [出生日], [卡余额], [消费金额], [消费密码], [消费积分]) VALUES (N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', N'', N'贺大礼', N'18702431601', N'18702431601', N'hdl', CAST(N'1997-12-18 00:00:00.000' AS DateTime), 1997, 12, 18, 1380.8000, 319.2000, N'34d91daab6d2eda3640b865d2f626805', 319.2000)
SET IDENTITY_INSERT [dbo].[进货明细表] ON 

INSERT [dbo].[进货明细表] ([序号], [日期], [商品序号], [进货单价], [数量], [金额]) VALUES (7, CAST(N'2017-10-06 00:00:00.000' AS DateTime), N'2e2042e1-79d9-4699-9fcf-b4a9df7d765e', 80.0000, 3, 240.0000)
INSERT [dbo].[进货明细表] ([序号], [日期], [商品序号], [进货单价], [数量], [金额]) VALUES (2, CAST(N'2017-10-06 00:00:00.000' AS DateTime), N'89252918-9fd5-4705-affc-0b70b39a35c7', 120.0000, 3, 360.0000)
INSERT [dbo].[进货明细表] ([序号], [日期], [商品序号], [进货单价], [数量], [金额]) VALUES (3, CAST(N'2018-02-06 00:00:00.000' AS DateTime), N'86225f24-be5c-433b-9acf-cd872cf02867', 80.0000, 4, 320.0000)
INSERT [dbo].[进货明细表] ([序号], [日期], [商品序号], [进货单价], [数量], [金额]) VALUES (4, CAST(N'2018-02-06 00:00:00.000' AS DateTime), N'f0d9d7e8-5c89-4bd0-ba8d-0ec9392ce5f1', 70.0000, 3, 210.0000)
INSERT [dbo].[进货明细表] ([序号], [日期], [商品序号], [进货单价], [数量], [金额]) VALUES (5, CAST(N'2018-02-06 00:00:00.000' AS DateTime), N'48bfd5d3-62c2-4eee-9fa9-50898d3726a2', 99.0000, 2, 198.0000)
INSERT [dbo].[进货明细表] ([序号], [日期], [商品序号], [进货单价], [数量], [金额]) VALUES (6, CAST(N'2018-02-25 00:00:00.000' AS DateTime), N'9ba89aa0-e80a-4317-a2ee-02711cc1bfc8', 120.0000, 5, 600.0000)
SET IDENTITY_INSERT [dbo].[进货明细表] OFF
INSERT [dbo].[商品表] ([商品序号], [商品种类], [厂家], [型号], [颜色], [尺码], [材质], [进货均价], [销售价], [会员打折], [会员销售价], [充值卡打折], [充值卡售价], [库存数量], [条码], [是否停用]) VALUES (N'2e2042e1-79d9-4699-9fcf-b4a9df7d765e', N'鞋子', N'鸿星尔克', N'跑鞋', N'白', N'37', N'轻', 80, 200, 0.85, 170, 0.8, 160, 3, N'20171006160019', N'否')
INSERT [dbo].[商品表] ([商品序号], [商品种类], [厂家], [型号], [颜色], [尺码], [材质], [进货均价], [销售价], [会员打折], [会员销售价], [充值卡打折], [充值卡售价], [库存数量], [条码], [是否停用]) VALUES (N'48bfd5d3-62c2-4eee-9fa9-50898d3726a2', N'鞋子', N'花花公子', N'跑鞋', N'白', N'36', N'轻', 99, 150, 0.85, 127.5, 0.8, 120, 2, N'20180206200151', N'否')
INSERT [dbo].[商品表] ([商品序号], [商品种类], [厂家], [型号], [颜色], [尺码], [材质], [进货均价], [销售价], [会员打折], [会员销售价], [充值卡打折], [充值卡售价], [库存数量], [条码], [是否停用]) VALUES (N'86225f24-be5c-433b-9acf-cd872cf02867', N'鞋子', N'特步', N'板鞋', N'黑', N'42', N'', 80, 150, 0.85, 127.5, 0.8, 120, 4, N'20180206190909', N'否')
INSERT [dbo].[商品表] ([商品序号], [商品种类], [厂家], [型号], [颜色], [尺码], [材质], [进货均价], [销售价], [会员打折], [会员销售价], [充值卡打折], [充值卡售价], [库存数量], [条码], [是否停用]) VALUES (N'89252918-9fd5-4705-affc-0b70b39a35c7', N'鞋子', N'鸿星尔克', N'跑鞋', N'白', N'36', N'', 120, 150, 0.85, 127.5, 0.8, 120, 3, N'20171006161136', N'否')
INSERT [dbo].[商品表] ([商品序号], [商品种类], [厂家], [型号], [颜色], [尺码], [材质], [进货均价], [销售价], [会员打折], [会员销售价], [充值卡打折], [充值卡售价], [库存数量], [条码], [是否停用]) VALUES (N'9ba89aa0-e80a-4317-a2ee-02711cc1bfc8', N'衣服', N'特步', N'羽绒服', N'白', N'156', N'羽绒', 120, 300, 0.85, 255, 0.8, 240, 4, N'20180225155453', N'否')
INSERT [dbo].[商品表] ([商品序号], [商品种类], [厂家], [型号], [颜色], [尺码], [材质], [进货均价], [销售价], [会员打折], [会员销售价], [充值卡打折], [充值卡售价], [库存数量], [条码], [是否停用]) VALUES (N'f0d9d7e8-5c89-4bd0-ba8d-0ec9392ce5f1', N'鞋子', N'Nike', N'板鞋', N'白', N'43', N'', 70, 150, 0.85, 127.5, 0.8, 120, 3, N'20180206195818', N'否')
SET IDENTITY_INSERT [dbo].[商品种类库] ON 

INSERT [dbo].[商品种类库] ([序号], [商品种类]) VALUES (2, N'包包')
INSERT [dbo].[商品种类库] ([序号], [商品种类]) VALUES (1, N'鞋子')
INSERT [dbo].[商品种类库] ([序号], [商品种类]) VALUES (3, N'衣服')
SET IDENTITY_INSERT [dbo].[商品种类库] OFF
SET IDENTITY_INSERT [dbo].[上缴明细表] ON 

INSERT [dbo].[上缴明细表] ([序号], [日期], [销售编号], [上缴现金], [上缴pos单]) VALUES (1, CAST(N'2018-02-06 00:00:00.000' AS DateTime), N'4be539ae-0300-4aff-83b9-afeb7dade7a0', 0.0000, 1000.0000)
SET IDENTITY_INSERT [dbo].[上缴明细表] OFF
INSERT [dbo].[系统设置] ([会员打折], [充值卡打折], [最低充值], [会员积分活动]) VALUES (0.8500, 0.8000, 0, 0)
INSERT [dbo].[销售记录] ([序号], [日期], [会员编号], [会员姓名], [销售编号], [销售姓名], [销售价], [数量], [应收], [优惠], [实收], [收款方式], [收款金额], [找零金额], [可用积分], [会员卡余额], [出货方式]) VALUES (1, CAST(N'2019-03-03 00:00:00.000' AS DateTime), N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', N'贺大礼', N'4be539ae-0300-4aff-83b9-afeb7dade7a0', N'贺大礼', 399.0000, 1, 399.0000, 79.8000, 319.2000, N'会员卡余额结帐', 319.2000, 0.0000, 319.2000, 680.8000, N'销售')
SET IDENTITY_INSERT [dbo].[销售明细表] ON 

INSERT [dbo].[销售明细表] ([序号], [日期], [销售序号], [商品序号], [会员编号], [会员姓名], [销售编号], [销售姓名], [销售价], [折扣], [折后价], [是否退货], [销售方式]) VALUES (2, CAST(N'2019-03-03 00:00:00.000' AS DateTime), 1, N'9ba89aa0-e80a-4317-a2ee-02711cc1bfc8', N'0d0abd64-239c-4017-8e89-98ca9bc5da8b', N'贺大礼', N'4be539ae-0300-4aff-83b9-afeb7dade7a0', N'贺大礼', 399.0000, 0.8000, 319.2000, N'否', N'销售')
SET IDENTITY_INSERT [dbo].[销售明细表] OFF
INSERT [dbo].[用户管理] ([用户编号], [登录名称], [真实姓名], [权限], [密码], [联系电话], [现金收款], [pos收款], [销售数量]) VALUES (N'B73C69C4-654C-751F-CA91-641EA80BECC7', N'a', N'a', N'一般操作员', N'a', NULL, NULL, NULL, NULL)
INSERT [dbo].[用户管理] ([用户编号], [登录名称], [真实姓名], [权限], [密码], [联系电话], [现金收款], [pos收款], [销售数量]) VALUES (N'4718359C-091B-FD8C-D160-2CC77758371A', N'asd', N'a', N'系统管理员', N'a', NULL, NULL, NULL, NULL)
INSERT [dbo].[用户管理] ([用户编号], [登录名称], [真实姓名], [权限], [密码], [联系电话], [现金收款], [pos收款], [销售数量]) VALUES (N'57852F87-AA2A-634F-EBCA-A7AF72F5E525', N'b', N'b', N'系统管理员', N'b', NULL, NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[支出明细表] ON 

INSERT [dbo].[支出明细表] ([序号], [支出明细], [支出金额], [支出日期], [登记日期], [备注]) VALUES (1, N'购买设备', 500.0000, CAST(N'2019-02-21 00:00:00.000' AS DateTime), CAST(N'2019-03-11 06:18:00.000' AS DateTime), N'购买打印机、pos机等')
INSERT [dbo].[支出明细表] ([序号], [支出明细], [支出金额], [支出日期], [登记日期], [备注]) VALUES (8, N'购买纸', 100.0000, CAST(N'2019-03-11 00:00:00.000' AS DateTime), CAST(N'2019-03-11 06:24:12.000' AS DateTime), N'')
SET IDENTITY_INSERT [dbo].[支出明细表] OFF
USE [master]
GO
ALTER DATABASE [data] SET  READ_WRITE 
GO
