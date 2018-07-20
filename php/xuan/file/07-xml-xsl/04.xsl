<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:template match="/">
        <html>
            <head>
                <title>XSL tutorial</title>
            </head>
        </html>
        <body>
        <div>
            <xsl:value-of select="bookshop/book/@id" />
            <xsl:for-each select="bookshop/book">
                 <xsl:value-of select="@id" /> <br/>
            </xsl:for-each>
        </div>
        </body>
    </xsl:template>
</xsl:stylesheet>